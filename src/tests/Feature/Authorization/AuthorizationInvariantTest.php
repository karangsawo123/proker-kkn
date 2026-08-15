<?php

namespace Tests\Feature\Authorization;

use App\Models\AdminAccount;
use App\Models\AgendaKegiatan;
use App\Models\AgendaMedia;
use App\Models\Desa;
use App\Models\Dusun;
use App\Models\Fasilitas;
use App\Models\KategoriFasilitas;
use App\Models\KontakPelayanan;
use App\Models\Pengumuman;
use App\Models\ProdukUmkm;
use App\Models\Umkm;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationInvariantTest extends TestCase
{
    use RefreshDatabase;

    private Desa $desa;

    private Dusun $dusunA;

    private Dusun $dusunB;

    private Dusun $inactiveDusun;

    private AdminAccount $adminDusunA;

    private AdminAccount $adminDusunB;

    private AdminAccount $adminInactiveDusun;

    private AdminAccount $superAdmin;

    private AdminAccount $removedAdmin;

    private KategoriFasilitas $kategori;

    protected function setUp(): void
    {
        parent::setUp();

        $this->desa = Desa::query()->forceCreate([
            'nama_desa' => 'Desa Bendung',
            'deskripsi_singkat' => 'Data sintetis untuk pengujian otorisasi.',
            'alamat_kantor' => 'Kantor Desa Bendung',
            'nomor_kontak' => '081200000001',
            'nama_kepala_desa' => 'Kepala Desa Bendung',
            'jam_pelayanan' => '08.00 - 15.00 WIB',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->dusunA = Dusun::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'nama_dusun' => 'Dusun A',
            'status_dusun' => 'ACTIVE',
            'deskripsi_singkat' => 'Dusun A aktif.',
            'nama_kepala_dusun' => 'Kadus A',
            'jumlah_rt' => 2,
            'jumlah_rw' => 1,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->dusunB = Dusun::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'nama_dusun' => 'Dusun B',
            'status_dusun' => 'ACTIVE',
            'deskripsi_singkat' => 'Dusun B aktif.',
            'nama_kepala_dusun' => 'Kadus B',
            'jumlah_rt' => 2,
            'jumlah_rw' => 1,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->inactiveDusun = Dusun::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'nama_dusun' => 'Dusun Inactive',
            'status_dusun' => 'INACTIVE',
            'deskripsi_singkat' => 'Dusun Inactive nonaktif.',
            'nama_kepala_dusun' => 'Kadus Inactive',
            'jumlah_rt' => 2,
            'jumlah_rw' => 1,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->adminDusunA = AdminAccount::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'username' => 'admin_a',
            'password_hash' => Hash::make('Pass123!'),
            'role' => 'ADMIN_DUSUN',
            'removed_at' => null,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->adminDusunB = AdminAccount::query()->forceCreate([
            'dusun_id' => $this->dusunB->id,
            'username' => 'admin_b',
            'password_hash' => Hash::make('Pass123!'),
            'role' => 'ADMIN_DUSUN',
            'removed_at' => null,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->adminInactiveDusun = AdminAccount::query()->forceCreate([
            'dusun_id' => $this->inactiveDusun->id,
            'username' => 'admin_inactive',
            'password_hash' => Hash::make('Pass123!'),
            'role' => 'ADMIN_DUSUN',
            'removed_at' => null,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->superAdmin = AdminAccount::query()->forceCreate([
            'dusun_id' => null,
            'username' => 'superadmin',
            'password_hash' => Hash::make('Pass123!'),
            'role' => 'SUPER_ADMIN',
            'removed_at' => null,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->removedAdmin = AdminAccount::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'username' => 'removed_admin',
            'password_hash' => Hash::make('Pass123!'),
            'role' => 'ADMIN_DUSUN',
            'removed_at' => CarbonImmutable::now(),
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->kategori = KategoriFasilitas::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'nama_kategori' => 'Kesehatan',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);
    }

    /**
     * AUTH-INV-001: Admin Dusun SHALL NOT membaca atau memutasi resource milik Dusun lain.
     */
    public function test_auth_inv_001_admin_dusun_cannot_access_or_mutate_foreign_dusun_resources(): void
    {
        $kontakB = KontakPelayanan::query()->forceCreate([
            'dusun_id' => $this->dusunB->id,
            'nama' => 'Kontak Dusun B',
            'jabatan' => 'Ketua RT B',
            'nomor_whatsapp' => '081234567890',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $umkmB = Umkm::query()->forceCreate([
            'dusun_id' => $this->dusunB->id,
            'nama_umkm' => 'UMKM Dusun B',
            'nama_pemilik' => 'Pak B',
            'jenis_usaha' => 'Kuliner',
            'deskripsi' => 'Deskripsi B',
            'alamat' => 'Alamat B',
            'nomor_whatsapp' => '081234567891',
            'jam_operasional' => '08.00-17.00',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $fasilitasB = Fasilitas::query()->forceCreate([
            'dusun_id' => $this->dusunB->id,
            'kategori_fasilitas_id' => $this->kategori->id,
            'nama' => 'Pos Ronda B',
            'deskripsi' => 'Pos ronda B',
            'alamat' => 'Alamat pos B',
            'latitude' => -7.323456,
            'longitude' => 112.854321,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $agendaB = AgendaKegiatan::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'dusun_id' => $this->dusunB->id,
            'scope_level' => 'DUSUN',
            'judul' => 'Rapat Dusun B',
            'deskripsi_singkat' => 'Rapat B',
            'tanggal_mulai' => CarbonImmutable::now()->addDays(2),
            'lokasi_text' => 'Balai Dusun B',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $pengumumanB = Pengumuman::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'dusun_id' => $this->dusunB->id,
            'scope_level' => 'DUSUN',
            'judul' => 'Kerja Bakti B',
            'isi' => 'Pengumuman Dusun B',
            'tanggal_kedaluwarsa' => CarbonImmutable::now()->addDays(7),
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        // Admin Dusun A MUST be denied access to Dusun B resources
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $kontakB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $kontakB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $kontakB));

        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $umkmB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $umkmB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $umkmB));

        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $fasilitasB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $fasilitasB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $fasilitasB));

        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $agendaB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $agendaB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $agendaB));

        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $pengumumanB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $pengumumanB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $pengumumanB));

        // Dusun profile itself
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $this->dusunB));
    }

    /**
     * AUTH-INV-002: Pengguna Publik SHALL NOT memiliki write access, account-management access, atau dashboard access.
     */
    public function test_auth_inv_002_public_user_cannot_access_management_or_admin_abilities(): void
    {
        $this->assertFalse(Gate::forUser(null)->allows('update', $this->desa));
        $this->assertFalse(Gate::forUser(null)->allows('create', AdminAccount::class));
        $this->assertFalse(Gate::forUser(null)->allows('create', KontakPelayanan::class));
    }

    /**
     * AUTH-INV-003: Hanya Super Admin SHALL dapat menjalankan restore data operasional.
     */
    public function test_auth_inv_003_only_super_admin_can_restore_operational_records(): void
    {
        $kontakA = KontakPelayanan::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'nama' => 'Kontak A',
            'jabatan' => 'Ketua RT A',
            'nomor_whatsapp' => '081234567890',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $umkmA = Umkm::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'nama_umkm' => 'UMKM A',
            'nama_pemilik' => 'Pak A',
            'jenis_usaha' => 'Kuliner',
            'deskripsi' => 'Deskripsi A',
            'alamat' => 'Alamat A',
            'nomor_whatsapp' => '081234567891',
            'jam_operasional' => '08.00-17.00',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        // Admin Dusun cannot restore own Dusun operational records
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('restore', $kontakA));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('restore', $umkmA));

        // Super Admin CAN restore
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('restore', $kontakA));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('restore', $umkmA));
    }

    /**
     * AUTH-INV-004: Tidak ada role yang SHALL dapat melakukan hard delete entitas Dusun.
     */
    public function test_auth_inv_004_no_role_can_hard_delete_dusun_entity(): void
    {
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('forceDelete', $this->dusunA));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $this->dusunA));

        $this->assertFalse(Gate::forUser($this->superAdmin)->allows('forceDelete', $this->dusunA));
        $this->assertFalse(Gate::forUser($this->superAdmin)->allows('delete', $this->dusunA));
    }

    /**
     * AUTH-INV-005: Hanya Super Admin SHALL dapat melakukan hard delete permanen pada entitas non-Dusun yang didukung.
     */
    public function test_auth_inv_005_only_super_admin_can_force_delete_supported_operational_entities(): void
    {
        $fasilitasA = Fasilitas::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'kategori_fasilitas_id' => $this->kategori->id,
            'nama' => 'Balai Pertemuan A',
            'deskripsi' => 'Balai pertemuan',
            'alamat' => 'Alamat balai A',
            'latitude' => -7.323456,
            'longitude' => 112.854321,
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        // Admin Dusun denied forceDelete
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('forceDelete', $fasilitasA));

        // Super Admin allowed forceDelete
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('forceDelete', $fasilitasA));
    }

    /**
     * AUTH-INV-006: Admin Dusun pada Dusun INACTIVE SHALL tetap dapat login dan mengelola dashboard Dusunnya sendiri.
     */
    public function test_auth_inv_006_admin_dusun_of_inactive_dusun_can_manage_own_dusun(): void
    {
        $kontakInactive = KontakPelayanan::query()->forceCreate([
            'dusun_id' => $this->inactiveDusun->id,
            'nama' => 'Kontak Inactive',
            'jabatan' => 'Ketua RT Inactive',
            'nomor_whatsapp' => '081234567890',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->assertTrue(Gate::forUser($this->adminInactiveDusun)->allows('view', $kontakInactive));
        $this->assertTrue(Gate::forUser($this->adminInactiveDusun)->allows('update', $kontakInactive));
        $this->assertTrue(Gate::forUser($this->adminInactiveDusun)->allows('delete', $kontakInactive));
        $this->assertTrue(Gate::forUser($this->adminInactiveDusun)->allows('update', $this->inactiveDusun));
    }

    /**
     * AUTH-INV-007: Data Soft Deleted boundaries.
     */
    public function test_auth_inv_007_soft_deleted_data_operational_matrix(): void
    {
        $umkm = Umkm::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'nama_umkm' => 'UMKM Soft Deleted Test',
            'nama_pemilik' => 'Pak Soft',
            'jenis_usaha' => 'Jasa',
            'deskripsi' => 'Deskripsi',
            'alamat' => 'Alamat',
            'nomor_whatsapp' => '081234567892',
            'jam_operasional' => '08.00-17.00',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        // Delete (soft delete) allowed for own Dusun admin
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('delete', $umkm));

        // Restore denied for Admin Dusun, allowed for Super Admin
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('restore', $umkm));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('restore', $umkm));
    }

    /**
     * AUTH-INV-008: Arsip Pengumuman publik SHALL diperlakukan terpisah dari Soft Delete.
     */
    public function test_auth_inv_008_pengumuman_archive_status_does_not_change_authorization(): void
    {
        $pengumumanExpired = Pengumuman::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'dusun_id' => $this->dusunA->id,
            'scope_level' => 'DUSUN',
            'judul' => 'Pengumuman Kedaluwarsa',
            'isi' => 'Pengumuman masa lalu',
            'tanggal_kedaluwarsa' => CarbonImmutable::now()->subDays(10),
            'created_at' => CarbonImmutable::now()->subDays(20),
            'updated_at' => CarbonImmutable::now()->subDays(20),
        ]);

        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('view', $pengumumanExpired));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('update', $pengumumanExpired));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('delete', $pengumumanExpired));
    }

    /**
     * AUTH-INV-009: Homepage / Global scope data management boundary.
     */
    public function test_auth_inv_009_desa_and_dusun_global_management_boundary(): void
    {
        // Desa management is Super Admin only
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $this->desa));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('update', $this->desa));

        // Desa-scoped agenda is Super Admin only
        $agendaDesa = AgendaKegiatan::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'dusun_id' => null,
            'scope_level' => 'DESA',
            'judul' => 'Musrenbangdes',
            'deskripsi_singkat' => 'Musrenbangdes tahunan',
            'tanggal_mulai' => CarbonImmutable::now()->addDays(5),
            'lokasi_text' => 'Balai Desa',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $agendaDesa));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $agendaDesa));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $agendaDesa));

        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('view', $agendaDesa));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('update', $agendaDesa));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('delete', $agendaDesa));
    }

    /**
     * AUTH-INV-010: Otorisasi lokasi, produk, dan media child SHALL mengikuti parent resource.
     */
    public function test_auth_inv_010_child_resources_inherit_parent_authorization_and_fail_closed(): void
    {
        $umkmA = Umkm::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'nama_umkm' => 'UMKM Parent A',
            'nama_pemilik' => 'Pak A',
            'jenis_usaha' => 'Kuliner',
            'deskripsi' => 'Deskripsi A',
            'alamat' => 'Alamat A',
            'nomor_whatsapp' => '081234567891',
            'jam_operasional' => '08.00-17.00',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $produkA = ProdukUmkm::query()->forceCreate([
            'umkm_id' => $umkmA->id,
            'nama_produk' => 'Keripik Pisang A',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $umkmB = Umkm::query()->forceCreate([
            'dusun_id' => $this->dusunB->id,
            'nama_umkm' => 'UMKM Parent B',
            'nama_pemilik' => 'Pak B',
            'jenis_usaha' => 'Kuliner',
            'deskripsi' => 'Deskripsi B',
            'alamat' => 'Alamat B',
            'nomor_whatsapp' => '081234567892',
            'jam_operasional' => '08.00-17.00',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $produkB = ProdukUmkm::query()->forceCreate([
            'umkm_id' => $umkmB->id,
            'nama_produk' => 'Keripik Singkong B',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        // Own parent: Admin A allowed
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('view', $produkA));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('update', $produkA));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('delete', $produkA));

        // Foreign parent: Admin A denied
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $produkB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $produkB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $produkB));

        // Unresolved parent fails closed
        $unlinkedProduct = new ProdukUmkm;
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('view', $unlinkedProduct));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $unlinkedProduct));

        // AgendaMedia inherits AgendaKegiatan
        $agendaA = AgendaKegiatan::query()->forceCreate([
            'desa_id' => $this->desa->id,
            'dusun_id' => $this->dusunA->id,
            'scope_level' => 'DUSUN',
            'judul' => 'Kegiatan A',
            'deskripsi_singkat' => 'Deskripsi A',
            'tanggal_mulai' => CarbonImmutable::now()->addDays(3),
            'lokasi_text' => 'Lokasi A',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $mediaA = AgendaMedia::query()->forceCreate([
            'agenda_kegiatan_id' => $agendaA->id,
            'media_path' => 'media/agenda_a.jpg',
            'media_role' => 'POSTER_AWAL',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('view', $mediaA));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('update', $mediaA));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('delete', $mediaA));
    }

    /**
     * AUTH-INV-011: Hanya Super Admin SHALL mengelola data tingkat Desa, kategori fasilitas, dan status Dusun.
     */
    public function test_auth_inv_011_super_admin_exclusive_capabilities(): void
    {
        // Category view is allowed for all admins
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('view', $this->kategori));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('view', $this->kategori));

        // Category mutations are Super Admin ONLY
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('create', KategoriFasilitas::class));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $this->kategori));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('delete', $this->kategori));

        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('create', KategoriFasilitas::class));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('update', $this->kategori));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('delete', $this->kategori));

        // Dusun activate / deactivate is Super Admin ONLY
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('activate', $this->dusunA));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('deactivate', $this->dusunA));

        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('activate', $this->dusunA));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('deactivate', $this->dusunA));

        // Admin Account management is Super Admin ONLY
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('create', AdminAccount::class));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('update', $this->adminDusunB));
        $this->assertFalse(Gate::forUser($this->adminDusunA)->allows('resetPassword', $this->adminDusunB));

        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('create', AdminAccount::class));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('update', $this->adminDusunB));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('assignDusun', $this->adminDusunB));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('resetPassword', $this->adminDusunB));
        $this->assertTrue(Gate::forUser($this->superAdmin)->allows('logicalRemove', $this->adminDusunB));

        // Removed admin account is strictly read-only (all mutations denied)
        $this->assertFalse(Gate::forUser($this->superAdmin)->allows('update', $this->removedAdmin));
        $this->assertFalse(Gate::forUser($this->superAdmin)->allows('assignDusun', $this->removedAdmin));
        $this->assertFalse(Gate::forUser($this->superAdmin)->allows('resetPassword', $this->removedAdmin));
        $this->assertFalse(Gate::forUser($this->superAdmin)->allows('logicalRemove', $this->removedAdmin));
    }

    /**
     * AUTH-INV-012: Perubahan Admin Dusun dalam scope yang sah SHALL langsung dipublikasikan tanpa approval Super Admin.
     */
    public function test_auth_inv_012_admin_dusun_authorized_directly_for_own_valid_scope(): void
    {
        $kontakA = KontakPelayanan::query()->forceCreate([
            'dusun_id' => $this->dusunA->id,
            'nama' => 'Bidan Desa Dusun A',
            'jabatan' => 'Bidan',
            'nomor_whatsapp' => '081234567890',
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ]);

        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('view', $kontakA));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('update', $kontakA));
        $this->assertTrue(Gate::forUser($this->adminDusunA)->allows('delete', $kontakA));
    }
}
