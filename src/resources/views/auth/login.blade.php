@extends('layouts.app')

@section('title', 'Login Admin — Portal Informasi Desa Bendung')
@section('body-class', 'auth-page-body')
@section('shell-class', 'auth-shell')

@section('content')
<div class="auth-viewport-bg" style="--auth-bg-image: url('{{ asset('images/balai-desa-bendung.webp') }}');">
    <div class="auth-overlay"></div>
    
    <div class="auth-card-wrapper">
        <div class="auth-glass-card">
            <header class="auth-card-header">
                <h1 class="auth-card-title">Login Admin</h1>
                <p class="auth-card-desc">Masuk ke panel administrator untuk mengelola data informasi Desa dan Dusun.</p>
            </header>

            @if ($errors->any())
                <div class="auth-alert-danger" role="alert" aria-live="polite">
                    <div class="auth-alert-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div class="auth-alert-content">
                        <ul class="auth-error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="auth-form" novalidate>
                @csrf

                <div class="auth-field-group">
                    <label for="username" class="auth-field-label">Username</label>
                    <div class="auth-input-wrapper">
                        <span class="auth-input-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            class="auth-input @error('username') is-invalid @enderror"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username Anda"
                            required
                            autofocus
                            autocomplete="username"
                            spellcheck="false"
                        >
                    </div>
                </div>

                <div class="auth-field-group">
                    <label for="password" class="auth-field-label">Password</label>
                    <div class="auth-input-wrapper">
                        <span class="auth-input-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="auth-input @error('password') is-invalid @enderror"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        >
                    </div>
                </div>

                <button type="submit" class="auth-submit-btn">
                    <span>Masuk</span>
                    <svg class="auth-btn-arrow" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

            <footer class="auth-card-footer">
                <a href="{{ route('home') }}" class="auth-back-link">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Kembali ke Beranda Portal</span>
                </a>
            </footer>
        </div>
    </div>
</div>
@endsection

