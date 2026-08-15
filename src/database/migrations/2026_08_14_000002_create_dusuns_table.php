<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dusuns', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->string('nama_dusun', 150);
            $table->string('status_dusun', 16)->default('ACTIVE');
            $table->string('banner_path', 512)->nullable();
            $table->text('deskripsi_singkat');
            $table->string('nama_kepala_dusun', 150);
            $table->unsignedSmallInteger('jumlah_rt');
            $table->unsignedSmallInteger('jumlah_rw');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('desa_id', 'fk_dusuns_desa_id')
                ->references('id')->on('desas')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->index(['desa_id', 'status_dusun'], 'idx_dusuns_desa_status');
        });

        DB::statement("ALTER TABLE dusuns ADD CONSTRAINT chk_dusuns_status CHECK (status_dusun IN ('ACTIVE', 'INACTIVE'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('dusuns');
    }
};
