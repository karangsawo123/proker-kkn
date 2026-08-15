<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak_pelayanans', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('dusun_id');
            $table->string('nama', 150);
            $table->string('jabatan', 150);
            $table->string('nomor_whatsapp', 32);
            $table->string('foto_path', 512)->nullable();
            $table->text('alamat_pelayanan')->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('dusun_id', 'fk_kontak_pelayanans_dusun_id')
                ->references('id')->on('dusuns')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->index(['dusun_id', 'deleted_at'], 'idx_kontak_pelayanans_dusun_deleted');
        });

        DB::statement('ALTER TABLE kontak_pelayanans ADD CONSTRAINT chk_kontak_pelayanans_coordinate_pair CHECK ((latitude IS NULL AND longitude IS NULL) OR (latitude IS NOT NULL AND longitude IS NOT NULL))');
        DB::statement('ALTER TABLE kontak_pelayanans ADD CONSTRAINT chk_kontak_pelayanans_latitude CHECK (latitude IS NULL OR latitude BETWEEN -90.000000 AND 90.000000)');
        DB::statement('ALTER TABLE kontak_pelayanans ADD CONSTRAINT chk_kontak_pelayanans_longitude CHECK (longitude IS NULL OR longitude BETWEEN -180.000000 AND 180.000000)');
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak_pelayanans');
    }
};
