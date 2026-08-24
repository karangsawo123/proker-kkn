<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAiService
{
    private bool $enabled;

    private string $provider;

    private ?string $baseUrl;

    private string $model;

    private ?string $apiKey;

    private int $timeout;

    private int $maxTokens;

    public function __construct()
    {
        $this->enabled = (bool) config('ai.enabled', true);
        $this->provider = strtolower((string) config('ai.provider', 'gemini'));
        $this->baseUrl = config('ai.base_url') ? trim((string) config('ai.base_url')) : null;
        $rawModel = (string) config('ai.model', 'gemini-3.5-flash-lite');
        $this->model = $this->provider === 'gemini' ? $this->normalizeModelName($rawModel) : $rawModel;
        $this->apiKey = trim((string) config('ai.api_key'), " \t\n\r\0\x0B\"'");
        $this->timeout = (int) config('ai.timeout_seconds', 20);
        $this->maxTokens = (int) config('ai.max_output_tokens', 2048);
    }

    private function normalizeModelName(string $rawModel): string
    {
        $cleaned = trim(strtolower($rawModel), " \t\n\r\0\x0B\"'");
        $cleaned = preg_replace('/\s+/', '-', $cleaned);

        if (str_contains($cleaned, 'flash-lite') || str_contains($cleaned, 'flash_lite') || str_contains($cleaned, 'lite')) {
            return 'gemini-3.5-flash-lite';
        }

        if ($cleaned === 'gemini-3.6-flash' || $cleaned === 'gemini-3.6' || $cleaned === 'gemini-3-6-flash') {
            return 'gemini-3.6-flash';
        }

        if ($cleaned === 'gemini-3.5-flash' || $cleaned === 'gemini-3.5') {
            return 'gemini-3.5-flash';
        }

        if ($cleaned === 'gemini-flash-latest' || $cleaned === 'flash-latest') {
            return 'gemini-flash-latest';
        }

        if (str_starts_with($cleaned, 'gemini-2') || str_starts_with($cleaned, 'gemini-1')) {
            return 'gemini-3.5-flash-lite';
        }

        return $cleaned ?: 'gemini-3.5-flash-lite';
    }

    /**
     * Check if AI service is configured and ready.
     */
    public function isAvailable(): bool
    {
        return $this->enabled && ! empty($this->apiKey);
    }

    /**
     * Generate structured draft or text improvement.
     *
     * @param  string  $feature  (pengumuman_draft|agenda_draft|umkm_draft|improve_text)
     * @param  string  $mode  (draft|rapikan|persingkat|formal)
     * @param  string|null  $notes  Factual raw notes supplied by admin
     * @param  string|null  $existingText  Existing text if improving
     *
     * @throws Exception
     */
    public function generate(string $feature, string $mode, ?string $notes = null, ?string $existingText = null): array
    {
        if (! $this->enabled) {
            throw new Exception('Layanan asisten AI sedang dinonaktifkan oleh administrator.');
        }

        if (empty($this->apiKey)) {
            throw new Exception('Kunci API asisten AI belum dikonfigurasi pada server.');
        }

        $systemInstruction = $this->buildSystemInstruction($feature, $mode);
        $userPrompt = $this->buildUserPrompt($feature, $mode, $notes, $existingText);

        if ($this->provider === 'gemini') {
            $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";
            $payload = [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $userPrompt],
                        ],
                    ],
                ],
                'systemInstruction' => [
                    'parts' => [
                        ['text' => $systemInstruction],
                    ],
                ],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                    'temperature' => 0.3,
                    'maxOutputTokens' => $this->maxTokens,
                ],
            ];
            $headers = [
                'x-goog-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ];
        } else {
            // OpenAI-Compatible Providers (9Router, OpenRouter, Groq, DeepSeek, etc.)
            $endpoint = $this->resolveOpenAiEndpoint();
            $payload = [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemInstruction],
                    ['role' => 'user', 'content' => $userPrompt],
                ],
                'temperature' => 0.3,
                'max_tokens' => $this->maxTokens,
            ];
            $headers = [
                'Authorization' => 'Bearer '.$this->apiKey,
                'HTTP-Referer' => 'https://bendung.online',
                'X-Title' => 'Portal Informasi Desa Bendung',
                'Content-Type' => 'application/json',
            ];
        }

        $startTime = microtime(true);

        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders($headers)
                ->post($endpoint, $payload);
            $latencyMs = round((microtime(true) - $startTime) * 1000);

            if (! $response->successful()) {
                $status = $response->status();
                $googleError = $response->json('error.message') ?? (string) $response->body();

                Log::warning('[AI_ASSISTANT] API request failed', [
                    'provider' => $this->provider,
                    'status' => $status,
                    'feature' => $feature,
                    'google_error' => $googleError,
                    'latency_ms' => $latencyMs,
                ]);

                if ($status === 429) {
                    throw new Exception('Batas kuota layanan AI tercapai. Silakan coba beberapa saat lagi.');
                }

                if ($status === 400 && str_contains(strtolower($googleError), 'api key')) {
                    throw new Exception('Kunci API AI tidak valid. Pastikan API Key di file .env sudah benar.');
                }

                if ($status === 404) {
                    throw new Exception("Model AI '{$this->model}' tidak ditemukan pada provider. Pastikan AI_MODEL di file .env sudah sesuai.");
                }

                if ($status === 403) {
                    throw new Exception('Akses API AI ditolak (403). Pastikan akun provider AI Anda aktif.');
                }

                $previewError = mb_strimwidth($googleError, 0, 160, '...');
                throw new Exception("Gagal menghubungi penyedia AI ({$status}): {$previewError}");
            }

            $responseData = $response->json();

            if ($this->provider === 'gemini') {
                $rawText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? null;
            } else {
                $rawText = $responseData['choices'][0]['message']['content'] ?? null;
            }

            if (empty($rawText)) {
                throw new Exception('Penyedia AI tidak mengembalikan konten yang valid.');
            }

            $parsedData = $this->parseResponseContent($rawText, $feature);

            Log::info('[AI_ASSISTANT] Draft generated successfully', [
                'feature' => $feature,
                'mode' => $mode,
                'latency_ms' => $latencyMs,
            ]);

            return $parsedData;
        } catch (Exception $e) {
            Log::error('[AI_ASSISTANT] Exception occurred', [
                'feature' => $feature,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Build strict system instructions forbidding fact invention and hallucination.
     */
    private function buildSystemInstruction(string $feature, string $mode): string
    {
        return <<<'INSTRUCTION'
Anda adalah asisten penulisan portal informasi desa resmi untuk Desa Bendung, Kapanewon Semin, Kabupaten Gunungkidul.
Tugas Anda HANYA menyusun, merapikan, atau memformat draf teks berdasarkan catatan fakta mentah yang diberikan oleh admin desa.

ATURAN KESELAMATAN & KEBIJAKAN KETAT:
1. HANYA gunakan fakta, nama, dan data yang secara eksplisit diberikan oleh admin.
2. JANGAN PERNAH mengarang tanggal, jam, durasi, lokasi gedung, nomor telepon, nama orang/pejabat, harga, atau klaim yang tidak tercantum dalam catatan admin.
3. Gunakan Bahasa Indonesia yang baku, sopan, komunikatif, dan sesuai etika pengumuman/informasi publik desa.
4. Jika catatan admin kurang lengkap, susun kerangka netral dan gunakan placeholder seperti "[Sebutkan rincian jika ada]" tanpa membuat detail fiktif.
5. Anda adalah asisten DRAFTING saja. Output WAJIB HANYA berupa JSON valid sesuai skema yang diminta, tanpa awalan atau akhiran markdown penjelasan.
INSTRUCTION;
    }

    /**
     * Build user prompt with expected JSON structure.
     */
    private function buildUserPrompt(string $feature, string $mode, ?string $notes, ?string $existingText): string
    {
        $prompt = "Mode Penulisan: {$mode}\n";

        if ($notes) {
            $prompt .= "Catatan/Poin Fakta Admin:\n{$notes}\n\n";
        }

        if ($existingText) {
            $prompt .= "Teks Saat Ini Yang Ingin Diperbaiki:\n{$existingText}\n\n";
        }

        switch ($feature) {
            case 'pengumuman_draft':
                $prompt .= 'Susun draf pengumuman resmi desa. Kembalikan HANYA JSON: {"judul": "Judul resmi yang jelas", "isi": "Isi lengkap pengumuman resmi..."}';
                break;

            case 'agenda_draft':
                $prompt .= 'Susun draf rincian agenda/kegiatan desa. Kembalikan HANYA JSON: {"judul": "Nama kegiatan", "deskripsi": "Deskripsi susunan dan rincian kegiatan..."}';
                break;

            case 'umkm_draft':
                $prompt .= 'Susun draf deskripsi profil UMKM/usaha warga desa yang menarik dan informatif. Kembalikan HANYA JSON: {"deskripsi": "Paragraf deskripsi UMKM..."}';
                break;

            case 'improve_text':
            default:
                if ($mode === 'persingkat') {
                    $prompt .= 'Persingkat teks di atas tanpa membuang informasi faktual penting. Kembalikan HANYA JSON: {"teks_hasil": "Teks ringkas..."}';
                } elseif ($mode === 'formal') {
                    $prompt .= 'Ubah teks di atas menjadi gaya bahasa resmi/formal instansi desa yang sopan. Kembalikan HANYA JSON: {"teks_hasil": "Teks formal..."}';
                } else {
                    $prompt .= 'Rapikan ejaan, tanda baca, dan susunan kalimat teks di atas tanpa mengubah fakta. Kembalikan HANYA JSON: {"teks_hasil": "Teks rapi..."}';
                }
                break;
        }

        return $prompt;
    }

    /**
     * Resolve endpoint URL for OpenAI-compatible providers.
     */
    private function resolveOpenAiEndpoint(): string
    {
        if (! empty($this->baseUrl)) {
            $base = rtrim($this->baseUrl, '/');

            return str_ends_with($base, '/chat/completions') ? $base : "{$base}/chat/completions";
        }

        return match ($this->provider) {
            'openrouter' => 'https://openrouter.ai/api/v1/chat/completions',
            'groq' => 'https://api.groq.com/openai/v1/chat/completions',
            '9router' => 'http://localhost:20128/v1/chat/completions',
            default => 'https://openrouter.ai/api/v1/chat/completions',
        };
    }

    /**
     * Parse structured JSON from raw model text, stripping code fences or gracefully falling back.
     */
    private function parseResponseContent(string $rawText, string $feature): array
    {
        $cleanText = trim($rawText);

        // 1. Strip markdown code fences if present (e.g. ```json ... ``` or ``` ...)
        if (preg_match('/^```(?:json)?\s*(.*?)\s*```$/s', $cleanText, $matches)) {
            $cleanText = trim($matches[1]);
        }

        // 2. Try direct json_decode
        $decoded = json_decode($cleanText, true);
        if (is_array($decoded) && ! empty($decoded)) {
            return $this->formatParsedOutput($decoded, $feature, $cleanText);
        }

        // 3. Extract JSON object substring if model added surrounding text
        if (preg_match('/\{[\s\S]*\}/', $cleanText, $jsonMatch)) {
            $decoded = json_decode($jsonMatch[0], true);
            if (is_array($decoded) && ! empty($decoded)) {
                return $this->formatParsedOutput($decoded, $feature, $cleanText);
            }
        }

        // 4. Regex extraction for specific keys (handles incomplete or partially cut-off JSON)
        $extractedJudul = null;
        $extractedIsi = null;

        if (preg_match('/"judul"\s*:\s*"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"/s', $cleanText, $mJudul)) {
            $extractedJudul = stripslashes($mJudul[1]);
        }

        if (preg_match('/"(?:isi|deskripsi|teks_hasil)"\s*:\s*"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"/s', $cleanText, $mText)) {
            $extractedIsi = stripslashes($mText[1]);
        } elseif (preg_match('/"(?:isi|deskripsi|teks_hasil)"\s*:\s*"([^"]*)$/s', $cleanText, $mTextCut)) {
            $extractedIsi = stripslashes($mTextCut[1]);
        }

        if ($extractedJudul || $extractedIsi) {
            return match ($feature) {
                'pengumuman_draft' => [
                    'judul' => $extractedJudul ?: 'Pengumuman Resmi',
                    'isi' => $extractedIsi ?: '',
                ],
                'agenda_draft' => [
                    'judul' => $extractedJudul ?: 'Agenda Kegiatan',
                    'deskripsi' => $extractedIsi ?: '',
                ],
                'umkm_draft' => [
                    'deskripsi' => $extractedIsi ?: ($extractedJudul ?: $cleanText),
                ],
                default => [
                    'teks_hasil' => $extractedIsi ?: ($extractedJudul ?: $cleanText),
                ],
            };
        }

        // 5. Graceful Fallback if model returned plain text instead of JSON
        $lines = array_values(array_filter(array_map('trim', explode("\n", $cleanText))));
        $firstLine = $lines[0] ?? 'Draf Otomatis';
        $remainingLines = implode("\n", array_slice($lines, 1));
        $fallbackBody = ! empty($remainingLines) ? $remainingLines : $cleanText;

        return match ($feature) {
            'pengumuman_draft' => [
                'judul' => ltrim($firstLine, '#* -'),
                'isi' => $fallbackBody,
            ],
            'agenda_draft' => [
                'judul' => ltrim($firstLine, '#* -'),
                'deskripsi' => $fallbackBody,
            ],
            'umkm_draft' => [
                'deskripsi' => $cleanText,
            ],
            default => [
                'teks_hasil' => $cleanText,
            ],
        };
    }

    /**
     * Map decoded array keys to expected domain attributes.
     */
    private function formatParsedOutput(array $data, string $feature, string $fallback): array
    {
        return match ($feature) {
            'pengumuman_draft' => [
                'judul' => (string) ($data['judul'] ?? $data['title'] ?? 'Pengumuman Resmi'),
                'isi' => (string) ($data['isi'] ?? $data['content'] ?? $data['deskripsi'] ?? $fallback),
            ],
            'agenda_draft' => [
                'judul' => (string) ($data['judul'] ?? $data['nama_kegiatan'] ?? 'Agenda Kegiatan'),
                'deskripsi' => (string) ($data['deskripsi'] ?? $data['isi'] ?? $fallback),
            ],
            'umkm_draft' => [
                'deskripsi' => (string) ($data['deskripsi'] ?? $data['isi'] ?? $data['deskripsi_usaha'] ?? $fallback),
            ],
            default => [
                'teks_hasil' => (string) ($data['teks_hasil'] ?? $data['hasil'] ?? $data['isi'] ?? $fallback),
            ],
        };
    }
}
