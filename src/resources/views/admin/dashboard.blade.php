@extends('layouts.admin')

@section('title', 'Dashboard Dusun ' . $dusun->nama_dusun)
@section('breadcrumb', 'Dashboard')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="admin-page-kicker">Admin Dusun</p>
        <h1 class="admin-page-title">Dashboard</h1>
        <p class="admin-page-desc">Ringkasan pengelolaan {{ $dusun->nama_dusun }}.</p>
    </div>
</div>

<div class="dashboard-context">
    <section class="dashboard-context-card" aria-labelledby="dusun-context-title">
        <h2 class="dashboard-context-title" id="dusun-context-title">{{ $dusun->nama_dusun }}</h2>
        <p class="admin-page-desc">Ruang kerja input dan perawatan data publik untuk wilayah dusun ini.</p>
        <div class="dashboard-context-meta">
            <span class="badge {{ $dusun->status_dusun === 'ACTIVE' ? 'badge-success' : 'badge-danger' }}">
                {{ $dusun->status_dusun === 'ACTIVE' ? 'ACTIVE' : 'INACTIVE' }}
            </span>
            <span class="badge badge-primary">{{ $dusun->jumlah_rt }} RT</span>
            <span class="badge badge-primary">{{ $dusun->jumlah_rw }} RW</span>
        </div>
    </section>

    <section class="dashboard-panel" aria-labelledby="quick-actions-title">
        <div class="dashboard-panel-header">
            <div>
                <h2 class="dashboard-panel-title" id="quick-actions-title">Aksi cepat</h2>
                <p class="dashboard-panel-desc">Mulai input data utama dusun.</p>
            </div>
        </div>
        <div class="dashboard-panel-body">
            <div class="quick-action-grid">
                <a href="{{ route('admin-dusun.kontak.create') }}" class="quick-action">Tambah Kontak <span aria-hidden="true">+</span></a>
                <a href="{{ route('admin-dusun.umkm.create') }}" class="quick-action">Tambah UMKM <span aria-hidden="true">+</span></a>
                <a href="{{ route('admin-dusun.fasilitas.create') }}" class="quick-action">Tambah Fasilitas <span aria-hidden="true">+</span></a>
                <a href="{{ route('admin-dusun.agenda.create') }}" class="quick-action">Tambah Agenda <span aria-hidden="true">+</span></a>
                <a href="{{ route('admin-dusun.pengumuman.create') }}" class="quick-action">Tambah Pengumuman <span aria-hidden="true">+</span></a>
            </div>
        </div>
    </section>
</div>

@if($dusun->status_dusun === 'INACTIVE')
    <div class="alert-box alert-warning">
        <div class="alert-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <div class="alert-title">Status Wilayah Nonaktif Publik</div>
            <p class="alert-desc">Dusun Anda saat ini tidak ditampilkan di website publik. Anda tetap dapat mengelola data profil, kontak, UMKM, fasilitas, agenda, dan pengumuman dengan normal.</p>
        </div>
    </div>
@endif

<div class="admin-stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        </div>
        <div class="stat-card-label">Kontak</div>
        <div class="stat-card-value">{{ $kontakCount }}</div>
        <a href="{{ route('admin-dusun.kontak.index') }}" class="stat-card-link">Kelola Kontak</a>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        </div>
        <div class="stat-card-label">UMKM</div>
        <div class="stat-card-value">{{ $umkmCount }}</div>
        <a href="{{ route('admin-dusun.umkm.index') }}" class="stat-card-link">Kelola UMKM</a>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <div class="stat-card-label">Fasilitas</div>
        <div class="stat-card-value">{{ $fasilitasCount }}</div>
        <a href="{{ route('admin-dusun.fasilitas.index') }}" class="stat-card-link">Kelola Fasilitas</a>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div class="stat-card-label">Agenda</div>
        <div class="stat-card-value">{{ $agendaCount }}</div>
        <a href="{{ route('admin-dusun.agenda.index') }}" class="stat-card-link">Kelola Agenda</a>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <div class="stat-card-label">Pengumuman</div>
        <div class="stat-card-value">{{ $pengumumanCount }}</div>
        <a href="{{ route('admin-dusun.pengumuman.index') }}" class="stat-card-link">Kelola Pengumuman</a>
    </div>
</div>

<div class="admin-card-section">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">Ringkasan Profil Dusun</h2>
            <a href="{{ route('admin-dusun.profil.edit') }}" class="btn btn-sm btn-primary">Edit Profil</a>
        </div>
        <div class="admin-card-body">
            <div class="profile-summary-grid">
                <div class="profile-item">
                    <span class="profile-label">Nama Dusun</span>
                    <span class="profile-value">{{ $dusun->nama_dusun }}</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Kepala Dusun</span>
                    <span class="profile-value">{{ $dusun->nama_kepala_dusun ?? 'Belum ditentukan' }}</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Struktur Wilayah</span>
                    <span class="profile-value">{{ $dusun->jumlah_rt }} RT / {{ $dusun->jumlah_rw }} RW</span>
                </div>
                <div class="profile-item">
                    <span class="profile-label">Status Wilayah</span>
                    <span class="profile-value">
                        <span class="badge {{ $dusun->status_dusun === 'ACTIVE' ? 'badge-success' : 'badge-danger' }}">
                            {{ $dusun->status_dusun === 'ACTIVE' ? 'Aktif Publik' : 'Nonaktif Publik' }}
                        </span>
                    </span>
                </div>
            </div>
            @if($dusun->deskripsi_singkat)
                <div class="profile-desc-box">
                    <span class="profile-label">Deskripsi Dusun</span>
                    <p class="profile-desc-text">{{ $dusun->deskripsi_singkat }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
