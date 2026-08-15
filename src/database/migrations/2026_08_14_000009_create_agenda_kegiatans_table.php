<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda_kegiatans', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->unsignedBigInteger('dusun_id')->nullable();
            $table->string('scope_level', 16);
            $table->string('judul', 255);
            $table->text('deskripsi_singkat');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->time('jam')->nullable();
            $table->string('lokasi_text', 255);
            $table->string('manual_status_override', 20)->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('desa_id', 'fk_agenda_kegiatans_desa_id')
                ->references('id')->on('desas')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('dusun_id', 'fk_agenda_kegiatans_dusun_id')
                ->references('id')->on('dusuns')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->index(
                ['dusun_id', 'deleted_at', 'tanggal_mulai'],
                'idx_agenda_kegiatans_dusun_deleted_mulai'
            );
            $table->index(
                ['desa_id', 'scope_level', 'deleted_at', 'tanggal_mulai'],
                'idx_agenda_kegiatans_desa_scope_deleted_mulai'
            );
        });

        DB::statement("ALTER TABLE agenda_kegiatans ADD CONSTRAINT chk_agenda_kegiatans_scope CHECK ((scope_level = 'DESA' AND dusun_id IS NULL) OR (scope_level = 'DUSUN' AND dusun_id IS NOT NULL))");
        DB::statement('ALTER TABLE agenda_kegiatans ADD CONSTRAINT chk_agenda_kegiatans_dates CHECK (tanggal_selesai IS NULL OR tanggal_selesai >= tanggal_mulai)');
        DB::statement("ALTER TABLE agenda_kegiatans ADD CONSTRAINT chk_agenda_kegiatans_override CHECK (manual_status_override IS NULL OR manual_status_override IN ('AKAN_DATANG', 'BERLANGSUNG', 'SELESAI'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_kegiatans');
    }
};
