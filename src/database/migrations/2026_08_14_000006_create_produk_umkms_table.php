<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_umkms', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('umkm_id');
            $table->string('nama_produk', 200);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('umkm_id', 'fk_produk_umkms_umkm_id')
                ->references('id')->on('umkms')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->index('umkm_id', 'idx_produk_umkms_umkm');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_umkms');
    }
};
