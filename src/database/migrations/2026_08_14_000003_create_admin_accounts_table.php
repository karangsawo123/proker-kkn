<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_accounts', function (Blueprint $table): void {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->unsignedBigInteger('dusun_id')->nullable();
            $table->string('username', 100);
            $table->string('password_hash', 255);
            $table->string('role', 24);
            $table->dateTime('removed_at')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('dusun_id', 'fk_admin_accounts_dusun_id')
                ->references('id')->on('dusuns')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->unique('username', 'uq_admin_accounts_username');
            $table->index(['dusun_id', 'removed_at'], 'idx_admin_accounts_dusun_removed');
        });

        DB::statement("ALTER TABLE admin_accounts ADD CONSTRAINT chk_admin_accounts_role CHECK (role IN ('ADMIN_DUSUN', 'SUPER_ADMIN'))");
        DB::statement("ALTER TABLE admin_accounts ADD CONSTRAINT chk_admin_accounts_role_scope CHECK ((role = 'ADMIN_DUSUN' AND dusun_id IS NOT NULL) OR (role = 'SUPER_ADMIN' AND dusun_id IS NULL))");
        DB::statement("ALTER TABLE admin_accounts ADD CONSTRAINT chk_admin_accounts_removed_role CHECK (role = 'ADMIN_DUSUN' OR removed_at IS NULL)");
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_accounts');
    }
};
