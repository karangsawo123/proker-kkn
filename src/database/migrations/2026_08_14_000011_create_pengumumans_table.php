<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->unsignedBigInteger('dusun_id')->nullable();
            $table->string('scope_level', 16);
            $table->string('judul', 255);
            $table->text('isi');
            $table->date('tanggal_kedaluwarsa');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('desa_id', 'fk_pengumumans_desa_id')
                ->references('id')->on('desas')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('dusun_id', 'fk_pengumumans_dusun_id')
                ->references('id')->on('dusuns')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->index(
                ['dusun_id', 'deleted_at', 'tanggal_kedaluwarsa'],
                'idx_pengumumans_dusun_deleted_expiry'
            );
            $table->index(
                ['desa_id', 'scope_level', 'deleted_at', 'tanggal_kedaluwarsa'],
                'idx_pengumumans_desa_scope_deleted_expiry'
            );
        });

        DB::statement("ALTER TABLE pengumumans ADD CONSTRAINT chk_pengumumans_scope CHECK ((scope_level = 'DESA' AND dusun_id IS NULL) OR (scope_level = 'DUSUN' AND dusun_id IS NOT NULL))");
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
