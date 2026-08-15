<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dusun') — Portal Informasi Desa Bendung</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Navigasi Utama Admin">
            <div class="admin-sidebar-header">
                <div class="admin-brand">
                    <span class="admin-brand-icon">🏛️</span>
                    <div>
                        <div class="admin-brand-title">Portal Desa Bendung</div>
                        <div class="admin-brand-subtitle">Admin Dusun</div>
                    </div>
                </div>
                <button type="button" class="admin-sidebar-close" id="sidebarCloseBtn" aria-label="Tutup Menu">✕</button>
            </div>

            <!-- Dusun Context Card -->
            @php
                $currentDusun = auth()->user()?->dusun;
            @endphp
            @if($currentDusun)
                <div class="admin-context-card">
                    <div class="admin-context-label">DUSUN TERDAFTAR</div>
                    <div class="admin-context-name">{{ $currentDusun->nama_dusun }}</div>
                    <div class="admin-context-badge {{ $currentDusun->status_dusun === 'ACTIVE' ? 'badge-active' : 'badge-inactive' }}">
                        {{ $currentDusun->status_dusun === 'ACTIVE' ? 'Status: Aktif' : 'Status: Nonaktif Publik' }}
                    </div>
                </div>
            @endif

            <!-- Navigation Links -->
            <nav class="admin-nav">
                <a href="{{ route('admin-dusun.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a href="{{ route('admin-dusun.profil.edit') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.profil.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏡</span>
                    <span class="nav-text">Profil Dusun</span>
                </a>
                <a href="{{ route('admin-dusun.kontak.index') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.kontak.*') ? 'active' : '' }}">
                    <span class="nav-icon">☎️</span>
                    <span class="nav-text">Kontak Pelayanan</span>
                </a>
                <a href="{{ route('admin-dusun.umkm.index') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.umkm.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏪</span>
                    <span class="nav-text">Kelola UMKM</span>
                </a>
                <a href="{{ route('admin-dusun.fasilitas.index') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.fasilitas.*') ? 'active' : '' }}">
                    <span class="nav-icon">📍</span>
                    <span class="nav-text">Kelola Fasilitas</span>
                </a>
                <a href="{{ route('admin-dusun.agenda.index') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.agenda.*') ? 'active' : '' }}">
                    <span class="nav-icon">📅</span>
                    <span class="nav-text">Agenda & Kegiatan</span>
                </a>
                <a href="{{ route('admin-dusun.pengumuman.index') }}" class="admin-nav-item {{ request()->routeIs('admin-dusun.pengumuman.*') ? 'active' : '' }}">
                    <span class="nav-icon">📢</span>
                    <span class="nav-text">Kelola Pengumuman</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('home') }}" target="_blank" class="admin-public-link" rel="noopener">
                    🌐 Lihat Website Publik
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="admin-main">
            <!-- Admin Top Header -->
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button type="button" class="admin-menu-toggle" id="sidebarToggleBtn" aria-label="Buka Menu">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    <div class="admin-breadcrumb">
                        @yield('breadcrumb', 'Admin Dusun')
                    </div>
                </div>

                <div class="admin-topbar-right">
                    <div class="admin-user-pill">
                        <span class="admin-user-avatar">👤</span>
                        <span class="admin-user-name">{{ auth()->user()?->username }}</span>
                        <span class="admin-role-tag">Admin Dusun</span>
                    </div>

                    <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="btn-logout" title="Keluar">
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Alert Notice if Dusun is INACTIVE -->
            @if($currentDusun && $currentDusun->status_dusun === 'INACTIVE')
                <div class="admin-banner-notice banner-warning" role="alert">
                    <div class="banner-icon">⚠️</div>
                    <div class="banner-content">
                        <strong>Perhatian: Dusun Berstatus Nonaktif Publik</strong>
                        <p>Dusun ini saat ini berstatus NONAKTIF di portal publik. Data yang Anda kelola tetap tersimpan dan dapat diedit, namun tidak ditampilkan kepada publik hingga diaktifkan kembali oleh Super Admin.</p>
                    </div>
                </div>
            @endif

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="admin-flash flash-success" role="status">
                    <span class="flash-icon">✓</span>
                    <span class="flash-message">{{ session('success') }}</span>
                    <button type="button" class="flash-close" onclick="this.parentElement.remove();" aria-label="Tutup notifikasi">×</button>
                </div>
            @endif

            <!-- Global Validation Error Summary -->
            @if($errors->any())
                <div class="admin-flash flash-error" role="alert">
                    <span class="flash-icon">✕</span>
                    <div class="flash-message">
                        <strong>Terdapat kesalahan pada isian form:</strong>
                        <ul class="error-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Main Page View Content -->
            <main class="admin-content" id="mainContent">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Confirmation Modal Dialog for Nonaktifkan / Soft Delete -->
    <div class="admin-modal" id="deactivateModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="admin-modal-backdrop" id="modalBackdrop"></div>
        <div class="admin-modal-dialog">
            <div class="admin-modal-header">
                <h3 class="admin-modal-title" id="modalTitle">Konfirmasi Nonaktifkan</h3>
                <button type="button" class="admin-modal-close" id="modalCloseBtn" aria-label="Tutup modal">×</button>
            </div>
            <div class="admin-modal-body">
                <p id="modalDescription">Data akan dinonaktifkan dan tidak lagi tampil di halaman publik.</p>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn btn-secondary" id="modalCancelBtn">Batal</button>
                <form id="modalForm" method="POST" action="" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="modalConfirmBtn">Nonaktifkan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Admin Drawer & Modal Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar Toggle for Mobile
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const closeBtn = document.getElementById('sidebarCloseBtn');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                });
            }

            if (closeBtn && sidebar) {
                closeBtn.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                });
            }

            // Modal Logic
            const modal = document.getElementById('deactivateModal');
            const modalBackdrop = document.getElementById('modalBackdrop');
            const modalCloseBtn = document.getElementById('modalCloseBtn');
            const modalCancelBtn = document.getElementById('modalCancelBtn');
            const modalForm = document.getElementById('modalForm');

            window.openDeactivateModal = function(actionUrl, itemName = '') {
                modalForm.action = actionUrl;
                if (itemName) {
                    document.getElementById('modalDescription').textContent =
                        `Data "${itemName}" akan dinonaktifkan dan tidak lagi tampil di halaman publik.`;
                } else {
                    document.getElementById('modalDescription').textContent =
                        'Data akan dinonaktifkan dan tidak lagi tampil di halaman publik.';
                }
                modal.classList.add('show');
                modal.setAttribute('aria-hidden', 'false');
            };

            function closeModal() {
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
            }

            if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
            if (modalCancelBtn) modalCancelBtn.addEventListener('click', closeModal);
            if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('show')) {
                    closeModal();
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
