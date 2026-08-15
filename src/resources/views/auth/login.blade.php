@extends('layouts.app')

@section('title', 'Login Admin — Portal Informasi Desa Bendung')

@section('content')
<div class="auth-container">
    <div class="surface stack">
        <header class="stack" style="text-align: center;">
            <p class="eyebrow">Portal Informasi Desa Bendung</p>
            <h1 style="font-size: 1.75rem; margin-top: var(--space-1);">Login Admin</h1>
        </header>

        @if ($errors->any())
            <div class="alert-danger" role="alert">
                <ul style="margin: 0; padding-inline-start: var(--space-2);">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="stack">
            @csrf

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    class="form-input"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn-primary" style="margin-top: var(--space-2);">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection
