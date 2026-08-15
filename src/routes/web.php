<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\AgendaController;
use App\Http\Controllers\Public\DusunController;
use App\Http\Controllers\Public\FasilitasController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PengumumanArchiveController;
use App\Http\Controllers\Public\PengumumanController;
use App\Http\Controllers\Public\UmkmController;
use Illuminate\Support\Facades\Route;

// ════════════════════════════════════════════════════════════════════════════
// PUBLIC ROUTES — no auth middleware (7 routes)
// ════════════════════════════════════════════════════════════════════════════

// UX-SCR-001 + UX-SCR-008 — Homepage (Peta Desa is section #peta-desa)
Route::get('/', HomeController::class)->name('home');

// UX-SCR-002 + UX-SCR-009 — Halaman Dusun (Peta Dusun is section #peta-dusun)
Route::get('/dusun/{id}', [DusunController::class, 'show'])
    ->whereNumber('id')
    ->name('dusun.show');

// UX-SCR-003 — Arsip Pengumuman (MUST be declared before /{id} route)
Route::get('/pengumuman/arsip', [PengumumanArchiveController::class, 'index'])
    ->name('pengumuman.arsip');

// UX-SCR-004 — Detail UMKM
Route::get('/umkm/{id}', [UmkmController::class, 'show'])
    ->whereNumber('id')
    ->name('umkm.show');

// UX-SCR-005 — Detail Fasilitas
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])
    ->whereNumber('id')
    ->name('fasilitas.show');

// UX-SCR-006 — Detail Agenda/Kegiatan
Route::get('/agenda/{id}', [AgendaController::class, 'show'])
    ->whereNumber('id')
    ->name('agenda.show');

// UX-SCR-007 — Detail Pengumuman
Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])
    ->whereNumber('id')
    ->name('pengumuman.show');

// ════════════════════════════════════════════════════════════════════════════
// AUTHENTICATION ROUTES — DEV-04 (preserved)
// ════════════════════════════════════════════════════════════════════════════

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
});

Route::middleware(['auth', 'admin.active'])->group(function (): void {
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('role:ADMIN_DUSUN')->group(function (): void {
        Route::get('/admin-dusun/dashboard', function () {
            return view('admin.placeholders.admin-dusun-dashboard');
        })->name('admin-dusun.dashboard');
    });

    Route::middleware('role:SUPER_ADMIN')->group(function (): void {
        Route::get('/super-admin/dashboard', function () {
            return view('admin.placeholders.super-admin-dashboard');
        })->name('super-admin.dashboard');
    });
});
