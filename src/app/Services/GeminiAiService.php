<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAiService
{
    private bool $enabled;

    private string $model;

    private ?string $apiKey;

    private int $timeout;

    private int $maxTokens;

    public function __construct()
    {
        $this->enabled = (bool) config('ai.enabled', true);
        $this->model = (string) config('ai.model', 'gemini-1.5-flash');
        $this->apiKey = config('ai.api_key');
        $this->timeout = (int) config('ai.timeout_seconds', 15);
        $this->maxTokens = (int) config('ai.max_output_tokens', 600);
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
                'temperature' => 0.2,
                'maxOutputTokens' => $this->maxTokens,
            ],
        ];

        $startTime = microtime(true);

        try {
            $response = Http::timeout($this->timeout)->post($endpoint, $payload);
            $latencyMs = round((microtime(true) - $startTime) * 1000);

            if (! $response->successful()) {
                $status = $response->status();
                Log::warning('[AI_ASSISTANT] API request failed', [
                    'status' => $status,
                    'feature' => $feature,
                    'latency_ms' => $latencyMs,
                ]);

                if ($status === 429) {
                    throw new Exception('Batas kuota layanan AI tercapai. Silakan coba beberapa saat lagi.');
                }

                throw new Exception('Gagal menghubungi penyedia layanan AI. Silakan gunakan pengisian manual.');
            }

            $responseData = $response->json();
            $rawText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (empty($rawText)) {
                throw new Exception('Penyedia AI tidak mengembalikan konten yang valid.');
            }

            $parsedData = json_decode($rawText, true);

            if (! is_array($parsedData)) {
                throw new Exception('Format respons AI tidak sesuai standar JSON terstruktur.');
            }

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
}
