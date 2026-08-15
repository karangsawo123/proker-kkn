<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_fasilitas', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->string('nama_kategori', 150);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('desa_id', 'fk_kategori_fasilitas_desa_id')
                ->references('id')->on('desas')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->unique(['desa_id', 'nama_kategori'], 'uq_kategori_fasilitas_desa_nama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_fasilitas');
    }
};
