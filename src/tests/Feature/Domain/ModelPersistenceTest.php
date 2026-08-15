<?php

namespace Tests\Feature\Domain;

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
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ModelPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_model_inventory_maps_exactly_to_the_eleven_domain_tables(): void
    {
        $models = [
            Desa::class => 'desas',
            Dusun::class => 'dusuns',
            AdminAccount::class => 'admin_accounts',
            KontakPelayanan::class => 'kontak_pelayanans',
            Umkm::class => 'umkms',
            ProdukUmkm::class => 'produk_umkms',
            KategoriFasilitas::class => 'kategori_fasilitas',
            Fasilitas::class => 'fasilitas',
            AgendaKegiatan::class => 'agenda_kegiatans',
            AgendaMedia::class => 'agenda_medias',
            Pengumuman::class => 'pengumumans',
        ];

        $this->assertCount(11, $models);

        foreach ($models as $modelClass => $table) {
            $model = new $modelClass;

            $this->assertSame($table, $model->getTable());
            $this->assertSame('id', $model->getKeyName());
            $this->assertTrue($model->getIncrementing());
            $this->assertSame('int', $model->getKeyType());
            $this->assertTrue($model->usesTimestamps());
            $this->assertSame(['*'], $model->getGuarded());
        }
    }

    public function test_relationship_metadata_matches_the_thirteen_foreign_keys_and_inverses(): void
    {
        $relationships = [
            [new Dusun, 'desa', Desa::class, 'desa_id', new Desa, 'dusuns'],
            [new AdminAccount, 'dusun', Dusun::class, 'dusun_id', new Dusun, 'adminAccounts'],
            [new KontakPelayanan, 'dusun', Dusun::class, 'dusun_id', new Dusun, 'kontakPelayanans'],
            [new Umkm, 'dusun', Dusun::class, 'dusun_id', new Dusun, 'umkms'],
            [new ProdukUmkm, 'umkm', Umkm::class, 'umkm_id', new Umkm, 'produkUmkms'],
            [new KategoriFasilitas, 'desa', Desa::class, 'desa_id', new Desa, 'kategoriFasilitas'],
            [new Fasilitas, 'kategoriFasilitas', KategoriFasilitas::class, 'kategori_fasilitas_id', new KategoriFasilitas, 'fasilitas'],
            [new Fasilitas, 'dusun', Dusun::class, 'dusun_id', new Dusun, 'fasilitas'],
            [new AgendaKegiatan, 'desa', Desa::class, 'desa_id', new Desa, 'agendaKegiatans'],
            [new AgendaKegiatan, 'dusun', Dusun::class, 'dusun_id', new Dusun, 'agendaKegiatans'],
            [new AgendaMedia, 'agendaKegiatan', AgendaKegiatan::class, 'agenda_kegiatan_id', new AgendaKegiatan, 'agendaMedias'],
            [new Pengumuman, 'desa', Desa::class, 'desa_id', new Desa, 'pengumumans'],
            [new Pengumuman, 'dusun', Dusun::class, 'dusun_id', new Dusun, 'pengumumans'],
        ];

        $this->assertCount(13, $relationships);

        foreach ($relationships as [$child, $childMethod, $parentClass, $foreignKey, $parent, $inverseMethod]) {
            $belongsTo = $child->{$childMethod}();
            $hasMany = $parent->{$inverseMethod}();

            $this->assertInstanceOf(BelongsTo::class, $belongsTo);
            $this->assertSame($parentClass, $belongsTo->getRelated()::class);
            $this->assertSame($foreignKey, $belongsTo->getForeignKeyName());
            $this->assertSame('id', $belongsTo->getOwnerKeyName());
            $this->assertInstanceOf(HasMany::class, $hasMany);
            $this->assertSame($child::class, $hasMany->getRelated()::class);
            $this->assertSame($foreignKey, $hasMany->getForeignKeyName());
            $this->assertSame('id', $hasMany->getLocalKeyName());
        }
    }

    public function test_models_persist_relationships_and_precision_safe_casts_on_mariadb(): void
    {
        $this->assertSame('mysql', DB::connection()->getDriverName());
        $this->assertSame('portal_desa_bendung_test', DB::connection()->getDatabaseName());
        $this->assertStringContainsString('MariaDB', DB::selectOne('SELECT VERSION() AS version')->version);

        $records = $this->persistCompleteDomainGraph();

        $this->assertTrue($records['dusun']->desa->is($records['desa']));
        $this->assertTrue($records['admin']->dusun->is($records['dusun']));
        $this->assertTrue($records['kontak']->dusun->is($records['dusun']));
        $this->assertTrue($records['umkm']->dusun->is($records['dusun']));
        $this->assertTrue($records['produk']->umkm->is($records['umkm']));
        $this->assertTrue($records['kategori']->desa->is($records['desa']));
        $this->assertTrue($records['fasilitas']->kategoriFasilitas->is($records['kategori']));
        $this->assertTrue($records['fasilitas']->dusun->is($records['dusun']));
        $this->assertTrue($records['agenda']->desa->is($records['desa']));
        $this->assertTrue($records['agenda']->dusun->is($records['dusun']));
        $this->assertTrue($records['media']->agendaKegiatan->is($records['agenda']));
        $this->assertTrue($records['pengumuman']->desa->is($records['desa']));
        $this->assertTrue($records['pengumuman']->dusun->is($records['dusun']));

        $this->assertSame('-7.123456', $records['kontak']->latitude);
        $this->assertSame('112.654321', $records['kontak']->longitude);
        $this->assertSame('-7.223456', $records['umkm']->latitude);
        $this->assertSame('112.754321', $records['umkm']->longitude);
        $this->assertSame('-7.323456', $records['fasilitas']->latitude);
        $this->assertSame('112.854321', $records['fasilitas']->longitude);
        $this->assertInstanceOf(CarbonInterface::class, $records['admin']->removed_at);
        $this->assertInstanceOf(CarbonInterface::class, $records['agenda']->tanggal_mulai);
        $this->assertInstanceOf(CarbonInterface::class, $records['agenda']->tanggal_selesai);
        $this->assertInstanceOf(CarbonInterface::class, $records['pengumuman']->tanggal_kedaluwarsa);
    }

    public function test_soft_delete_contract_is_limited_to_the_five_lifecycle_models(): void
    {
        $softDeleteModels = [
            KontakPelayanan::class,
            Umkm::class,
            Fasilitas::class,
            AgendaKegiatan::class,
            Pengumuman::class,
        ];
        $nonSoftDeleteModels = [
            Desa::class,
            Dusun::class,
            AdminAccount::class,
            ProdukUmkm::class,
            KategoriFasilitas::class,
            AgendaMedia::class,
        ];

        $this->assertCount(5, $softDeleteModels);

        foreach ($softDeleteModels as $modelClass) {
            $this->assertContains(SoftDeletes::class, class_uses_recursive($modelClass));
        }

        foreach ($nonSoftDeleteModels as $modelClass) {
            $this->assertNotContains(SoftDeletes::class, class_uses_recursive($modelClass));
        }

        $records = $this->persistCompleteDomainGraph();

        foreach (['kontak', 'umkm', 'fasilitas', 'agenda', 'pengumuman'] as $key) {
            $record = $records[$key];
            $modelClass = $record::class;
            $id = $record->getKey();

            $record->delete();

            $this->assertNull($modelClass::find($id));
            $this->assertNotNull($modelClass::withTrashed()->find($id));
        }

        $this->assertInstanceOf(CarbonInterface::class, $records['admin']->removed_at);
        $this->assertFalse(method_exists($records['admin'], 'trashed'));
    }

    public function test_agenda_lifecycle_is_date_based_with_nullable_end_and_manual_override(): void
    {
        config()->set('app.business_timezone', 'Asia/Jakarta');

        $agenda = (new AgendaKegiatan)->forceFill([
            'tanggal_mulai' => '2026-08-20',
            'tanggal_selesai' => '2026-08-22',
            'manual_status_override' => null,
        ]);

        $this->assertSame('AKAN_DATANG', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-19 23:59:59', 'Asia/Jakarta')));
        $this->assertSame('BERLANGSUNG', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-20 00:00:00', 'Asia/Jakarta')));
        $this->assertSame('BERLANGSUNG', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-22 23:59:59', 'Asia/Jakarta')));
        $this->assertSame('SELESAI', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-23 00:00:00', 'Asia/Jakarta')));
        $this->assertSame('BERLANGSUNG', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-19 17:30:00', 'UTC')));

        $agenda->tanggal_selesai = null;
        $this->assertSame('BERLANGSUNG', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-20', 'Asia/Jakarta')));
        $this->assertSame('SELESAI', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-21', 'Asia/Jakarta')));

        $agenda->manual_status_override = 'AKAN_DATANG';
        $this->assertSame('AKAN_DATANG', $agenda->effectiveStatusFor(CarbonImmutable::parse('2026-08-30', 'Asia/Jakarta')));
    }

    public function test_pengumuman_archive_status_uses_expiry_day_and_is_independent_from_soft_delete(): void
    {
        config()->set('app.business_timezone', 'Asia/Jakarta');

        $pengumuman = (new Pengumuman)->forceFill([
            'tanggal_kedaluwarsa' => '2026-08-20',
        ]);

        $this->assertFalse($pengumuman->isArchivedFor(CarbonImmutable::parse('2026-08-20 23:59:59', 'Asia/Jakarta')));
        $this->assertTrue($pengumuman->isArchivedFor(CarbonImmutable::parse('2026-08-21 00:00:00', 'Asia/Jakarta')));
        $this->assertTrue($pengumuman->isArchivedFor(CarbonImmutable::parse('2026-08-20 17:30:00', 'UTC')));

        $pengumuman->deleted_at = CarbonImmutable::parse('2026-08-19', 'Asia/Jakarta');

        $this->assertFalse($pengumuman->isArchivedFor(CarbonImmutable::parse('2026-08-20', 'Asia/Jakarta')));
    }

    /**
     * @return array<string, Model>
     */
    private function persistCompleteDomainGraph(): array
    {
        $desa = $this->persist(new Desa, [
            'nama_desa' => 'Desa Uji DEV-03',
            'deskripsi_singkat' => 'Data sintetis untuk pengujian model.',
            'alamat_kantor' => 'Alamat uji',
            'nomor_kontak' => '6280000000000',
            'nama_kepala_desa' => 'Kepala Desa Uji',
            'jam_pelayanan' => '08.00-15.00',
        ]);
        $dusun = $this->persist(new Dusun, [
            'desa_id' => $desa->id,
            'nama_dusun' => 'Dusun Uji',
            'status_dusun' => 'ACTIVE',
            'deskripsi_singkat' => 'Data sintetis.',
            'nama_kepala_dusun' => 'Kepala Dusun Uji',
            'jumlah_rt' => 2,
            'jumlah_rw' => 1,
        ]);
        $admin = $this->persist(new AdminAccount, [
            'dusun_id' => $dusun->id,
            'username' => 'admin-dev03',
            'password_hash' => 'not-a-real-password-hash',
            'role' => 'ADMIN_DUSUN',
            'removed_at' => '2026-08-14 12:00:00',
        ]);
        $kontak = $this->persist(new KontakPelayanan, [
            'dusun_id' => $dusun->id,
            'nama' => 'Kontak Uji',
            'jabatan' => 'Jabatan Uji',
            'nomor_whatsapp' => '6280000000001',
            'latitude' => '-7.123456',
            'longitude' => '112.654321',
        ]);
        $umkm = $this->persist(new Umkm, [
            'dusun_id' => $dusun->id,
            'nama_umkm' => 'UMKM Uji',
            'nama_pemilik' => 'Pemilik Uji',
            'jenis_usaha' => 'Usaha Uji',
            'deskripsi' => 'Data sintetis.',
            'alamat' => 'Alamat uji',
            'nomor_whatsapp' => '6280000000002',
            'jam_operasional' => '08.00-17.00',
            'latitude' => '-7.223456',
            'longitude' => '112.754321',
        ]);
        $produk = $this->persist(new ProdukUmkm, [
            'umkm_id' => $umkm->id,
            'nama_produk' => 'Produk Uji',
        ]);
        $kategori = $this->persist(new KategoriFasilitas, [
            'desa_id' => $desa->id,
            'nama_kategori' => 'Kategori Uji',
        ]);
        $fasilitas = $this->persist(new Fasilitas, [
            'dusun_id' => $dusun->id,
            'kategori_fasilitas_id' => $kategori->id,
            'nama' => 'Fasilitas Uji',
            'deskripsi' => 'Data sintetis.',
            'alamat' => 'Alamat uji',
            'latitude' => '-7.323456',
            'longitude' => '112.854321',
        ]);
        $agenda = $this->persist(new AgendaKegiatan, [
            'desa_id' => $desa->id,
            'dusun_id' => $dusun->id,
            'scope_level' => 'DUSUN',
            'judul' => 'Agenda Uji',
            'deskripsi_singkat' => 'Data sintetis.',
            'tanggal_mulai' => '2026-08-20',
            'tanggal_selesai' => '2026-08-22',
            'lokasi_text' => 'Lokasi uji',
        ]);
        $media = $this->persist(new AgendaMedia, [
            'agenda_kegiatan_id' => $agenda->id,
            'media_path' => 'agenda/uji.jpg',
            'media_role' => 'POSTER_AWAL',
        ]);
        $pengumuman = $this->persist(new Pengumuman, [
            'desa_id' => $desa->id,
            'dusun_id' => $dusun->id,
            'scope_level' => 'DUSUN',
            'judul' => 'Pengumuman Uji',
            'isi' => 'Data sintetis.',
            'tanggal_kedaluwarsa' => '2026-08-31',
        ]);

        return compact(
            'desa',
            'dusun',
            'admin',
            'kontak',
            'umkm',
            'produk',
            'kategori',
            'fasilitas',
            'agenda',
            'media',
            'pengumuman',
        );
    }

    /**
     * @template TModel of Model
     *
     * @param  TModel  $model
     * @param  array<string, mixed>  $attributes
     * @return TModel
     */
    private function persist(Model $model, array $attributes): Model
    {
        $model->forceFill($attributes)->save();

        return $model->refresh();
    }
}
