@extends('layouts.admin')

@section('title', 'Dashboard Dusun ' . $dusun->nama_dusun)
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Dashboard Admin Dusun</h1>
        <p class="admin-page-desc">Selamat datang di panel pengelolaan data wilayah <strong>{{ $dusun->nama_dusun }}</strong>.</p>
    </div>
</div>

<!-- Dusun Status Banner Info -->
@if($dusun->status_dusun === 'INACTIVE')
    <div class="alert-box alert-warning">
        <div class="alert-title">⚠️ Status Wilayah Nonaktif Publik</div>
        <p class="alert-desc">Dusun Anda saat ini tidak ditampilkan di website publik. Anda tetap dapat mengelola data profil, kontak, UMKM, fasilitas, agenda, dan pengumuman dengan normal.</p>
    </div>
@endif

<!-- Summary Statistics Cards -->
<div class="admin-stats-grid">
    <div class="stat-card">
        <div class="stat-icon">☎️</div>
        <div class="stat-data">
            <div class="stat-number">{{ $kontakCount }}</div>
            <div class="stat-label">Kontak Pelayanan</div>
        </div>
        <a href="{{ route('admin-dusun.kontak.index') }}" class="stat-link">Kelola Kontak &rarr;</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🏪</div>
        <div class="stat-data">
            <div class="stat-number">{{ $umkmCount }}</div>
            <div class="stat-label">UMKM Terdaftar</div>
        </div>
        <a href="{{ route('admin-dusun.umkm.index') }}" class="stat-link">Kelola UMKM &rarr;</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📍</div>
        <div class="stat-data">
            <div class="stat-number">{{ $fasilitasCount }}</div>
            <div class="stat-label">Fasilitas Dusun</div>
        </div>
        <a href="{{ route('admin-dusun.fasilitas.index') }}" class="stat-link">Kelola Fasilitas &rarr;</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-data">
            <div class="stat-number">{{ $agendaCount }}</div>
            <div class="stat-label">Agenda Kegiatan</div>
        </div>
        <a href="{{ route('admin-dusun.agenda.index') }}" class="stat-link">Kelola Agenda &rarr;</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📢</div>
        <div class="stat-data">
            <div class="stat-number">{{ $pengumumanCount }}</div>
            <div class="stat-label">Pengumuman Aktif</div>
        </div>
        <a href="{{ route('admin-dusun.pengumuman.index') }}" class="stat-link">Kelola Pengumuman &rarr;</a>
    </div>
</div>

<!-- Quick Overview / Dusun Profile Overview -->
<div class="admin-card-section" style="margin-top: 2rem;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Ringkasan Profil Dusun</h2>
            <a href="{{ route('admin-dusun.profil.edit') }}" class="btn btn-sm btn-primary">Edit Profil Dusun</a>
        </div>
        <div class="admin-card-body">
            <div class="profile-summary-grid">
                <div class="profile-item">
                    <span class="profile-label">Nama Dusun:</span>
                    <span class="profile-value font-bold">{{ $dusun->nama_dusun }}</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Kepala Dusun:</span>
                    <span class="profile-value">{{ $dusun->nama_kepala_dusun ?? 'Belum ditentukan' }}</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Struktur Wilayah:</span>
                    <span class="profile-value">{{ $dusun->jumlah_rt }} RT / {{ $dusun->jumlah_rw }} RW</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Status Wilayah:</span>
                    <span class="profile-value">
                        <span class="badge {{ $dusun->status_dusun === 'ACTIVE' ? 'badge-success' : 'badge-danger' }}">
                            {{ $dusun->status_dusun === 'ACTIVE' ? 'Aktif Publik' : 'Nonaktif Publik' }}
                        </span>
                    </span>
                </div>
            </div>
            @if($dusun->deskripsi_singkat)
                <div class="profile-desc-box">
                    <span class="profile-label">Deskripsi Dusun:</span>
                    <p class="profile-desc-text">{{ $dusun->deskripsi_singkat }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
