<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agenda_medias', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('agenda_kegiatan_id');
            $table->string('media_path', 512);
            $table->string('media_role', 24);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('agenda_kegiatan_id', 'fk_agenda_medias_agenda_kegiatan_id')
                ->references('id')->on('agenda_kegiatans')
                ->onUpdate('restrict')->onDelete('cascade');
            $table->index('agenda_kegiatan_id', 'idx_agenda_medias_agenda');
        });

        DB::statement("ALTER TABLE agenda_medias ADD CONSTRAINT chk_agenda_medias_role CHECK (media_role IN ('POSTER_AWAL', 'DOKUMENTASI'))");
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_medias');
    }
};
