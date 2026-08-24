<?php

namespace Tests\Feature\Admin;

use App\Models\AdminAccount;
use App\Models\Desa;
use App\Models\Dusun;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AiAssistantTest extends TestCase
{
    use RefreshDatabase;

    private Desa $desa;

    private Dusun $dusun;

    private AdminAccount $adminDusun;

    private AdminAccount $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'ai.enabled' => true,
            'ai.api_key' => 'fake-gemini-key-for-testing',
            'ai.model' => 'gemini-3.5-flash-lite',
        ]);

        $this->desa = Desa::query()->forceCreate([
            'nama_desa' => 'Desa Bendung',
            'deskripsi_singkat' => 'Deskripsi Desa.',
            'alamat_kantor' => 'Jl. Desa No. 1',
            'nomor_kontak' => '081234567890',
            'nama_kepala_desa' => 'Kepala Desa',
            'jam_pelayanan' => '08.00 - 15.00',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->dusun = Dusun::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'nama_dusun' => 'Dusun Karangsawo',
            'nama_kepala_dusun' => 'Bapak Subardi',
            'status_dusun' => 'ACTIVE',
            'deskripsi_singkat' => 'Deskripsi Karangsawo.',
            'jumlah_rt' => 4,
            'jumlah_rw' => 2,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->adminDusun = AdminAccount::query()->forceCreate([
            'username' => 'admindusun',
            'password_hash' => Hash::make('Secret123!'),
            'role' => 'ADMIN_DUSUN',
            'dusun_id' => $this->dusun->id,
            'removed_at' => null,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->superAdmin = AdminAccount::query()->forceCreate([
            'username' => 'superadmin',
            'password_hash' => Hash::make('Secret123!'),
            'role' => 'SUPER_ADMIN',
            'dusun_id' => null,
            'removed_at' => null,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);
    }

    public function test_unauthenticated_request_is_rejected(): void
    {
        $response = $this->postJson(route('admin.ai.generate-draft'), [
            'feature' => 'pengumuman_draft',
            'mode' => 'draft',
            'notes' => 'Posyandu balita',
        ]);

        $response->assertStatus(401);
    }

    public function test_admin_dusun_can_generate_pengumuman_draft(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'judul' => 'Pemberitahuan Pelaksanaan Posyandu Balita',
                                        'isi' => 'Diberitahukan kepada seluruh warga bahwa kegiatan posyandu akan dilaksanakan.',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'draft',
                'notes' => 'Posyandu balita selasa depan balai dusun',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'judul' => 'Pemberitahuan Pelaksanaan Posyandu Balita',
                'isi' => 'Diberitahukan kepada seluruh warga bahwa kegiatan posyandu akan dilaksanakan.',
            ],
        ]);
    }

    public function test_super_admin_can_generate_agenda_draft(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'judul' => 'Musyawarah Desa',
                                        'deskripsi' => 'Rincian musyawarah desa.',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($this->superAdmin)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'agenda_draft',
                'mode' => 'draft',
                'notes' => 'Musyawarah desa pembahasan anggaran',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'judul' => 'Musyawarah Desa',
                'deskripsi' => 'Rincian musyawarah desa.',
            ],
        ]);
    }

    public function test_admin_can_generate_umkm_draft(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'deskripsi' => 'Usaha produksi keripik singkong khas dusun.',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'umkm_draft',
                'mode' => 'draft',
                'notes' => 'Keripik singkong renyah aneka rasa',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'deskripsi' => 'Usaha produksi keripik singkong khas dusun.',
            ],
        ]);
    }

    public function test_admin_can_improve_writing(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'teks_hasil' => 'Teks yang telah dirapikan ejaannya.',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'improve_text',
                'mode' => 'rapikan',
                'existing_text' => 'teks yg blm rapi ejaanya',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'teks_hasil' => 'Teks yang telah dirapikan ejaannya.',
            ],
        ]);
    }

    public function test_markdown_wrapped_json_response_is_successfully_parsed(): void
    {
        $markdownJson = "```json\n".json_encode([
            'judul' => 'Pengumuman Kerja Bakti',
            'isi' => 'Rincian kerja bakti dusun.',
        ])."\n```";

        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => $markdownJson],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'draft',
                'notes' => 'Kerja bakti hari minggu',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'judul' => 'Pengumuman Kerja Bakti',
                'isi' => 'Rincian kerja bakti dusun.',
            ],
        ]);
    }

    public function test_invalid_feature_returns_validation_error(): void
    {
        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'unsupported_feature',
                'mode' => 'draft',
                'notes' => 'Some notes',
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['feature']);
    }

    public function test_invalid_mode_returns_validation_error(): void
    {
        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'invalid_mode',
                'notes' => 'Some notes',
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['mode']);
    }

    public function test_gemini_api_timeout_or_error_returns_graceful_json_error(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response(null, 500),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'draft',
                'notes' => 'Catatan',
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
        ]);
    }

    public function test_gemini_quota_exceeded_returns_rate_limit_message(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response(null, 429),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'draft',
                'notes' => 'Catatan',
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Batas kuota layanan AI tercapai. Silakan coba beberapa saat lagi.',
        ]);
    }

    public function test_ai_disabled_via_kill_switch_returns_error(): void
    {
        config(['ai.enabled' => false]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'draft',
                'notes' => 'Catatan',
            ]);

        $response->assertStatus(422);
        $response->assertJson([
            'success' => false,
            'message' => 'Layanan asisten AI sedang dinonaktifkan oleh administrator.',
        ]);
    }

    public function test_openai_compatible_provider_can_generate_draft(): void
    {
        config([
            'ai.enabled' => true,
            'ai.provider' => 'openai_compatible',
            'ai.base_url' => 'https://api.groq.com/openai/v1',
            'ai.model' => 'openai/gpt-oss-120b',
            'ai.api_key' => 'fake-openai-key',
        ]);

        Http::fake([
            'https://api.groq.com/openai/v1/chat/completions' => Http::response([
                'choices' => [
                    [
                        'message' => [
                            'content' => json_encode([
                                'judul' => 'Pengumuman Via Groq',
                                'isi' => 'Isi pengumuman via generic provider.',
                            ]),
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($this->adminDusun)
            ->postJson(route('admin.ai.generate-draft'), [
                'feature' => 'pengumuman_draft',
                'mode' => 'draft',
                'notes' => 'Catatan via provider generic',
            ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'judul' => 'Pengumuman Via Groq',
                'isi' => 'Isi pengumuman via generic provider.',
            ],
        ]);
    }
}
