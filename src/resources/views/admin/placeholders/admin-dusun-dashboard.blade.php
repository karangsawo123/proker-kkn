@extends('layouts.app')

@section('title', 'Admin Dusun Dashboard — Placeholder')

@section('content')
<div class="content-container stack">
    <div class="surface stack">
        <p class="eyebrow">DEVELOPMENT AUTH PLACEHOLDER</p>
        <h1>Dashboard Admin Dusun</h1>
        <p>Halaman ini adalah placeholder otentikasi sementara untuk verifikasi role ADMIN_DUSUN.</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-primary" style="max-width: 12rem;">
                Keluar (Logout)
            </button>
        </form>
    </div>
</div>
@endsection
