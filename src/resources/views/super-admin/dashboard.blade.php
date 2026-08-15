@extends('layouts.super-admin')

@section('title', 'Dashboard Super Admin')
@section('breadcrumb')
    <span>Dashboard Super Admin</span>
@endsection

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Dashboard Super Administrator</h1>
    <p class="admin-page-desc">Pusat kendali dan administrasi global untuk seluruh wilayah di {{ $desa->nama_desa ?? 'Desa Bendung' }}.</p>
</div>

<!-- Operational Overview Cards -->
<div class="admin-stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🏘️</div>
        <div class="stat-number">{{ $stats['dusun_active'] }} <span class="text-sm font-normal text-muted">/ {{ $stats['dusun_total'] }} Dusun</span></div>
        <div class="stat-label">Dusun Aktif Publik ({{ $stats['dusun_inactive'] }} Inaktif)</div>
        <a href="{{ route('super-admin.dusun.index') }}" class="stat-link">Kelola Dusun →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📞</div>
        <div class="stat-number">{{ $stats['kontak_active'] }}</div>
        <div class="stat-label">Kontak Pelayanan Aktif</div>
        <a href="{{ route('super-admin.kontak.index') }}" class="stat-link">Kelola Kontak →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🛍️</div>
        <div class="stat-number">{{ $stats['umkm_active'] }}</div>
        <div class="stat-label">Usaha Warga (UMKM)</div>
        <a href="{{ route('super-admin.umkm.index') }}" class="stat-link">Kelola UMKM →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📍</div>
        <div class="stat-number">{{ $stats['fasilitas_active'] }}</div>
        <div class="stat-label">Fasilitas Umum ({{ $stats['kategori_total'] }} Kategori)</div>
        <a href="{{ route('super-admin.fasilitas.index') }}" class="stat-link">Kelola Fasilitas →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-number">{{ $stats['agenda_active'] }}</div>
        <div class="stat-label">Agenda Kegiatan Desa & Dusun</div>
        <a href="{{ route('super-admin.agenda.index') }}" class="stat-link">Kelola Agenda →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📢</div>
        <div class="stat-number">{{ $stats['pengumuman_active'] }}</div>
        <div class="stat-label">Pengumuman & Berita</div>
        <a href="{{ route('super-admin.pengumuman.index') }}" class="stat-link">Kelola Pengumuman →</a>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-number">{{ $stats['admin_dusun_active'] }} <span class="text-sm font-normal text-muted">Akun</span></div>
        <div class="stat-label">Admin Dusun Terdaftar ({{ $stats['admin_dusun_removed'] }} Nonaktif)</div>
        <a href="{{ route('super-admin.admin-dusun.index') }}" class="stat-link">Kelola Akun Admin →</a>
    </div>
</div>

<!-- 10 Management Hub Quick Navigation -->
<div class="admin-card" style="margin-top: 1.5rem;">
    <div class="admin-card-header">
        <h2 class="admin-card-title">10 Area Manajemen Super Admin</h2>
    </div>
    <div class="admin-card-body">
        <div class="sa-hub-grid">
            <a href="{{ route('super-admin.desa.edit') }}" class="sa-hub-item">
                <span class="hub-icon">🏛️</span>
                <div>
                    <h3 class="hub-title">1. Identitas Desa</h3>
                    <p class="hub-desc">Nama desa, kepala desa, alamat kantor, kontak, jam pelayanan, dan banner.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.dusun.index') }}" class="sa-hub-item">
                <span class="hub-icon">🏘️</span>
                <div>
                    <h3 class="hub-title">2. Kelola Dusun</h3>
                    <p class="hub-desc">Profil 6 dusun, aktivasi/deaktivasi publik, nama kepala dusun, RT/RW.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.kontak.index') }}" class="sa-hub-item">
                <span class="hub-icon">📞</span>
                <div>
                    <h3 class="hub-title">3. Kontak Pelayanan</h3>
                    <p class="hub-desc">Manajemen kontak perangkat desa dan dusun, pemulihan, dan hapus permanen.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.umkm.index') }}" class="sa-hub-item">
                <span class="hub-icon">🛍️</span>
                <div>
                    <h3 class="hub-title">4. Kelola UMKM</h3>
                    <p class="hub-desc">Katalog produk dan usaha warga seluruh dusun, pemulihan, dan hapus permanen.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.fasilitas.index') }}" class="sa-hub-item">
                <span class="hub-icon">📍</span>
                <div>
                    <h3 class="hub-title">5. Kelola Fasilitas</h3>
                    <p class="hub-desc">Sarana dan prasarana umum, titik koordinat, pemulihan, dan hapus permanen.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.kategori-fasilitas.index') }}" class="sa-hub-item">
                <span class="hub-icon">🏷️</span>
                <div>
                    <h3 class="hub-title">6. Kategori Fasilitas</h3>
                    <p class="hub-desc">Master klasifikasi fasilitas desa (Kesehatan, Pendidikan, Olahraga, dll).</p>
                </div>
            </a>
            <a href="{{ route('super-admin.agenda.index') }}" class="sa-hub-item">
                <span class="hub-icon">📅</span>
                <div>
                    <h3 class="hub-title">7. Agenda & Kegiatan</h3>
                    <p class="hub-desc">Kegiatan tingkat desa & dusun, media poster dan dokumentasi kegiatan.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.pengumuman.index') }}" class="sa-hub-item">
                <span class="hub-icon">📢</span>
                <div>
                    <h3 class="hub-title">8. Pengumuman</h3>
                    <p class="hub-desc">Informasi dan berita resmi tingkat desa dan dusun beserta masa aktifnya.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.data-peta') }}" class="sa-hub-item">
                <span class="hub-icon">🗺️</span>
                <div>
                    <h3 class="hub-title">9. Data / Peta</h3>
                    <p class="hub-desc">Peta interaktif persebaran fasilitas, UMKM, dan kontak pelayanan.</p>
                </div>
            </a>
            <a href="{{ route('super-admin.admin-dusun.index') }}" class="sa-hub-item">
                <span class="hub-icon">👥</span>
                <div>
                    <h3 class="hub-title">10. Admin Dusun</h3>
                    <p class="hub-desc">Akun pengelola dusun, penugasan wilayah, reset kata sandi, dan penonaktifan.</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
