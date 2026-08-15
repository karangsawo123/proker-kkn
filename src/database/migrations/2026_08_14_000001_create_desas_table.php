<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desas', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->string('nama_desa', 150);
            $table->string('logo_path', 512)->nullable();
            $table->string('banner_path', 512)->nullable();
            $table->text('deskripsi_singkat');
            $table->text('alamat_kantor');
            $table->string('nomor_kontak', 32);
            $table->string('email', 254)->nullable();
            $table->string('nama_kepala_desa', 150);
            $table->string('jam_pelayanan', 255);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
