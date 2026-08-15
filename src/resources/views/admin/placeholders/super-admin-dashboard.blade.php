@extends('layouts.app')

@section('title', 'Super Admin Dashboard — Placeholder')

@section('content')
<div class="content-container stack">
    <div class="surface stack">
        <p class="eyebrow">DEVELOPMENT AUTH PLACEHOLDER</p>
        <h1>Dashboard Super Admin</h1>
        <p>Halaman ini adalah placeholder otentikasi sementara untuk verifikasi role SUPER_ADMIN.</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-primary" style="max-width: 12rem;">
                Keluar (Logout)
            </button>
        </form>
    </div>
</div>
@endsection
