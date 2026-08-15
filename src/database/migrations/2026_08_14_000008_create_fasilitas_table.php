<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('dusun_id');
            $table->unsignedBigInteger('kategori_fasilitas_id');
            $table->string('nama', 200);
            $table->text('deskripsi');
            $table->text('alamat');
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->string('foto_path', 512)->nullable();
            $table->string('nomor_whatsapp', 32)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('dusun_id', 'fk_fasilitas_dusun_id')
                ->references('id')->on('dusuns')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('kategori_fasilitas_id', 'fk_fasilitas_kategori_fasilitas_id')
                ->references('id')->on('kategori_fasilitas')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->index(['dusun_id', 'deleted_at'], 'idx_fasilitas_dusun_deleted');
            $table->index(['kategori_fasilitas_id', 'deleted_at'], 'idx_fasilitas_kategori_deleted');
        });

        DB::statement('ALTER TABLE fasilitas ADD CONSTRAINT chk_fasilitas_latitude CHECK (latitude BETWEEN -90.000000 AND 90.000000)');
        DB::statement('ALTER TABLE fasilitas ADD CONSTRAINT chk_fasilitas_longitude CHECK (longitude BETWEEN -180.000000 AND 180.000000)');
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
