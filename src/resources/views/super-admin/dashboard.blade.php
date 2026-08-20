@extends('layouts.super-admin')

@section('title', 'Dashboard Super Administrator')
@section('breadcrumb')
    <span>Dashboard Super Administrator</span>
@endsection

@section('content')
<div class="admin-page-header">
    <div>
        <p class="admin-page-kicker">Super Admin</p>
        <h1 class="admin-page-title">Dashboard</h1>
        <p class="admin-page-desc">Pusat kendali administrasi global untuk seluruh wilayah di {{ $desa->nama_desa ?? 'Desa Bendung' }}.</p>
    </div>
</div>

<div class="sa-dashboard-grid" aria-label="Ringkasan statistik Super Admin">
    <section class="sa-metric-group">
        <h2 class="sa-metric-heading">Wilayah</h2>
        <div class="sa-metric-list">
            <div class="sa-metric-item"><span class="sa-metric-label">Dusun Total</span><span class="sa-metric-value">{{ $stats['dusun_total'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">Aktif</span><span class="sa-metric-value">{{ $stats['dusun_active'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">Nonaktif</span><span class="sa-metric-value">{{ $stats['dusun_inactive'] }}</span></div>
        </div>
        <a href="{{ route('super-admin.dusun.index') }}" class="stat-card-link">Kelola Dusun</a>
    </section>

    <section class="sa-metric-group">
        <h2 class="sa-metric-heading">Data Desa</h2>
        <div class="sa-metric-list">
            <div class="sa-metric-item"><span class="sa-metric-label">Kontak</span><span class="sa-metric-value">{{ $stats['kontak_active'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">UMKM</span><span class="sa-metric-value">{{ $stats['umkm_active'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">Fasilitas</span><span class="sa-metric-value">{{ $stats['fasilitas_active'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">Kategori</span><span class="sa-metric-value">{{ $stats['kategori_total'] }}</span></div>
        </div>
        <a href="{{ route('super-admin.kontak.index') }}" class="stat-card-link">Kelola Kontak</a>
    </section>

    <section class="sa-metric-group">
        <h2 class="sa-metric-heading">Informasi</h2>
        <div class="sa-metric-list">
            <div class="sa-metric-item"><span class="sa-metric-label">Agenda</span><span class="sa-metric-value">{{ $stats['agenda_active'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">Pengumuman</span><span class="sa-metric-value">{{ $stats['pengumuman_active'] }}</span></div>
        </div>
        <a href="{{ route('super-admin.agenda.index') }}" class="stat-card-link">Kelola Agenda</a>
    </section>

    <section class="sa-metric-group">
        <h2 class="sa-metric-heading">Akun</h2>
        <div class="sa-metric-list">
            <div class="sa-metric-item"><span class="sa-metric-label">Admin Aktif</span><span class="sa-metric-value">{{ $stats['admin_dusun_active'] }}</span></div>
            <div class="sa-metric-item"><span class="sa-metric-label">Akun Dihapus</span><span class="sa-metric-value">{{ $stats['admin_dusun_removed'] }}</span></div>
        </div>
        <a href="{{ route('super-admin.admin-dusun.index') }}" class="stat-card-link">Kelola Akun Admin</a>
    </section>
</div>

<div class="admin-card-section">
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2 class="admin-card-title">Area Manajemen</h2>
                <p class="dashboard-panel-desc">Akses cepat ke modul administrasi global.</p>
            </div>
        </div>
        <div class="admin-card-body">
            <div class="sa-hub-grid">
                <a href="{{ route('super-admin.desa.edit') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">1. Identitas Desa</h3><p class="sa-hub-desc">Nama desa, kepala desa, alamat kantor, kontak, jam pelayanan, dan banner.</p></div>
                </a>
                <a href="{{ route('super-admin.dusun.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">2. Kelola Dusun</h3><p class="sa-hub-desc">Profil dusun, aktivasi publik, kepala dusun, dan RT/RW.</p></div>
                </a>
                <a href="{{ route('super-admin.kontak.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">3. Kontak Pelayanan</h3><p class="sa-hub-desc">Kontak perangkat desa dan dusun, pemulihan, dan hapus permanen.</p></div>
                </a>
                <a href="{{ route('super-admin.umkm.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">4. Kelola UMKM</h3><p class="sa-hub-desc">Katalog produk dan usaha warga seluruh dusun.</p></div>
                </a>
                <a href="{{ route('super-admin.fasilitas.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">5. Kelola Fasilitas</h3><p class="sa-hub-desc">Sarana umum, titik koordinat, pemulihan, dan hapus permanen.</p></div>
                </a>
                <a href="{{ route('super-admin.kategori-fasilitas.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">6. Kategori Fasilitas</h3><p class="sa-hub-desc">Master klasifikasi fasilitas desa.</p></div>
                </a>
                <a href="{{ route('super-admin.agenda.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">7. Agenda & Kegiatan</h3><p class="sa-hub-desc">Kegiatan desa dan dusun beserta media kegiatan.</p></div>
                </a>
                <a href="{{ route('super-admin.pengumuman.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">8. Pengumuman</h3><p class="sa-hub-desc">Informasi resmi beserta masa aktifnya.</p></div>
                </a>
                <a href="{{ route('super-admin.data-peta') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">9. Data / Peta</h3><p class="sa-hub-desc">Peta persebaran fasilitas, UMKM, dan kontak pelayanan.</p></div>
                </a>
                <a href="{{ route('super-admin.admin-dusun.index') }}" class="sa-hub-item">
                    <span class="sa-hub-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                    <div class="sa-hub-body"><h3 class="sa-hub-title">10. Admin Dusun</h3><p class="sa-hub-desc">Akun pengelola dusun, penugasan wilayah, dan reset kata sandi.</p></div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
