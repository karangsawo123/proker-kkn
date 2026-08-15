<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('foundation');
})->name('home');

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
