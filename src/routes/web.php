<?php

use App\Http\Controllers\Admin\AgendaKegiatanController as AdminAgendaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Admin\KontakPelayananController as AdminKontakController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\ProfilDusunController as AdminProfilDusunController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
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

    // ════════════════════════════════════════════════════════════════════════════
    // ADMIN DUSUN MANAGEMENT ROUTES — DEV-06 (UX-SCR-011 through UX-SCR-017)
    // ════════════════════════════════════════════════════════════════════════════
    Route::middleware('role:ADMIN_DUSUN')
        ->prefix('admin-dusun')
        ->name('admin-dusun.')
        ->group(function (): void {
            // UX-SCR-011: Dashboard Dusun
            Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

            // UX-SCR-012: Kelola Profil Dusun
            Route::get('/profil', [AdminProfilDusunController::class, 'edit'])->name('profil.edit');
            Route::put('/profil', [AdminProfilDusunController::class, 'update'])->name('profil.update');

            // UX-SCR-013: Kelola Kontak Pelayanan
            Route::resource('kontak', AdminKontakController::class)
                ->except(['show'])
                ->names('kontak');

            // UX-SCR-014: Kelola UMKM
            Route::resource('umkm', AdminUmkmController::class)
                ->except(['show'])
                ->names('umkm');

            // UX-SCR-015: Kelola Fasilitas
            Route::resource('fasilitas', AdminFasilitasController::class)
                ->except(['show'])
                ->names('fasilitas');

            // UX-SCR-016: Kelola Agenda & Kegiatan
            Route::resource('agenda', AdminAgendaController::class)
                ->except(['show'])
                ->names('agenda');

            // UX-SCR-017: Kelola Pengumuman
            Route::resource('pengumuman', AdminPengumumanController::class)
                ->except(['show'])
                ->names('pengumuman');
        });

    // Super Admin Dashboard placeholder — DEV-04 (preserved until DEV-07)
    Route::middleware('role:SUPER_ADMIN')->group(function (): void {
        Route::get('/super-admin/dashboard', function () {
            return view('admin.placeholders.super-admin-dashboard');
        })->name('super-admin.dashboard');
    });
});
