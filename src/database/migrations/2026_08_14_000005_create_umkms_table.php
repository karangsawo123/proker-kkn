<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('dusun_id');
            $table->string('nama_umkm', 200);
            $table->string('nama_pemilik', 150);
            $table->string('jenis_usaha', 150);
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('nomor_whatsapp', 32);
            $table->string('jam_operasional', 255);
            $table->string('foto_utama_path', 512)->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('dusun_id', 'fk_umkms_dusun_id')
                ->references('id')->on('dusuns')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->index(['dusun_id', 'deleted_at'], 'idx_umkms_dusun_deleted');
        });

        DB::statement('ALTER TABLE umkms ADD CONSTRAINT chk_umkms_coordinate_pair CHECK ((latitude IS NULL AND longitude IS NULL) OR (latitude IS NOT NULL AND longitude IS NOT NULL))');
        DB::statement('ALTER TABLE umkms ADD CONSTRAINT chk_umkms_latitude CHECK (latitude IS NULL OR latitude BETWEEN -90.000000 AND 90.000000)');
        DB::statement('ALTER TABLE umkms ADD CONSTRAINT chk_umkms_longitude CHECK (longitude IS NULL OR longitude BETWEEN -180.000000 AND 180.000000)');
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
