<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Super Admin') — Portal Desa Bendung</title>

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Leaflet CSS for Map/Picker -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Persistent Sidebar -->
        <aside class="admin-sidebar sa-sidebar" id="adminSidebar">
            <div class="admin-sidebar-header">
                <div class="admin-brand">
                    <span class="admin-brand-icon">🏛️</span>
                    <div>
                        <div class="admin-brand-title">Desa Bendung</div>
                        <div class="admin-brand-subtitle">Super Admin Portal</div>
                    </div>
                </div>
                <button type="button" class="admin-sidebar-close" id="sidebarCloseBtn" aria-label="Tutup Menu">
                    ✕
                </button>
            </div>

            <!-- Global Context Card -->
            <div class="admin-context-card sa-context-card">
                <span class="admin-context-label">HAK AKSES ADMINISTRASI</span>
                <div class="admin-context-name">Super Administrator</div>
                <span class="admin-context-badge badge-sa-global">
                    🌐 Akses Global Seluruh Desa
                </span>
            </div>

            <!-- Exactly 10 Management Navigation Links -->
            <nav class="admin-nav sa-nav" aria-label="Navigasi Super Admin">
                <a href="{{ route('super-admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('super-admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a href="{{ route('super-admin.desa.edit') }}" class="admin-nav-item {{ request()->routeIs('super-admin.desa.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏛️</span>
                    <span class="nav-text">1. Identitas Desa</span>
                </a>
                <a href="{{ route('super-admin.dusun.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.dusun.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏘️</span>
                    <span class="nav-text">2. Kelola Dusun</span>
                </a>
                <a href="{{ route('super-admin.kontak.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.kontak.*') ? 'active' : '' }}">
                    <span class="nav-icon">📞</span>
                    <span class="nav-text">3. Kontak Pelayanan</span>
                </a>
                <a href="{{ route('super-admin.umkm.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.umkm.*') ? 'active' : '' }}">
                    <span class="nav-icon">🛍️</span>
                    <span class="nav-text">4. Kelola UMKM</span>
                </a>
                <a href="{{ route('super-admin.fasilitas.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.fasilitas.*') ? 'active' : '' }}">
                    <span class="nav-icon">📍</span>
                    <span class="nav-text">5. Kelola Fasilitas</span>
                </a>
                <a href="{{ route('super-admin.kategori-fasilitas.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.kategori-fasilitas.*') ? 'active' : '' }}">
                    <span class="nav-icon">🏷️</span>
                    <span class="nav-text">6. Kategori Fasilitas</span>
                </a>
                <a href="{{ route('super-admin.agenda.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.agenda.*') ? 'active' : '' }}">
                    <span class="nav-icon">📅</span>
                    <span class="nav-text">7. Agenda & Kegiatan</span>
                </a>
                <a href="{{ route('super-admin.pengumuman.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.pengumuman.*') ? 'active' : '' }}">
                    <span class="nav-icon">📢</span>
                    <span class="nav-text">8. Pengumuman</span>
                </a>
                <a href="{{ route('super-admin.data-peta') }}" class="admin-nav-item {{ request()->routeIs('super-admin.data-peta') ? 'active' : '' }}">
                    <span class="nav-icon">🗺️</span>
                    <span class="nav-text">9. Data / Peta</span>
                </a>
                <a href="{{ route('super-admin.admin-dusun.index') }}" class="admin-nav-item {{ request()->routeIs('super-admin.admin-dusun.*') ? 'active' : '' }}">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">10. Admin Dusun</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('home') }}" target="_blank" class="admin-public-link">
                    🌐 Buka Portal Publik ↗
                </a>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="admin-main">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button type="button" class="admin-menu-toggle" id="menuToggleBtn" aria-label="Buka Menu">
                        ☰
                    </button>
                    <nav class="admin-breadcrumb" aria-label="Breadcrumb">
                        @yield('breadcrumb')
                    </nav>
                </div>
                <div class="admin-topbar-right">
                    <div class="admin-user-pill">
                        <span class="admin-user-name">{{ Auth::user()->username ?? 'Super Admin' }}</span>
                        <span class="admin-role-tag badge-sa-tag">SUPER_ADMIN</span>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline-form">
                        @csrf
                        <button type="submit" class="btn btn-logout" id="logoutBtn">
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Flash Feedback Alerts -->
            @if(session('success'))
                <div class="admin-flash flash-success" role="alert">
                    <span class="flash-icon">✓</span>
                    <div class="flash-message">{{ session('success') }}</div>
                    <button type="button" class="flash-close" onclick="this.parentElement.remove()">✕</button>
                </div>
            @endif

            @if(session('error'))
                <div class="admin-flash flash-error" role="alert">
                    <span class="flash-icon">⚠</span>
                    <div class="flash-message">{{ session('error') }}</div>
                    <button type="button" class="flash-close" onclick="this.parentElement.remove()">✕</button>
                </div>
            @endif

            @if($errors->any())
                <div class="admin-flash flash-error" role="alert">
                    <span class="flash-icon">⚠</span>
                    <div class="flash-message">
                        <strong>Terdapat kesalahan pada isian formulir:</strong>
                        <ul class="error-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="flash-close" onclick="this.parentElement.remove()">✕</button>
                </div>
            @endif

            <!-- Main Page Content -->
            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Universal Action Modals -->
    <!-- 1. Soft Delete / Nonaktifkan Modal -->
    <div class="admin-modal" id="deactivateModal" aria-hidden="true" role="dialog">
        <div class="admin-modal-backdrop" onclick="closeModal('deactivateModal')"></div>
        <div class="admin-modal-dialog">
            <div class="admin-modal-header">
                <h3 class="admin-modal-title">Konfirmasi Nonaktifkan Data</h3>
                <button type="button" class="admin-modal-close" onclick="closeModal('deactivateModal')">✕</button>
            </div>
            <div class="admin-modal-body">
                <p>Apakah Anda yakin ingin menonaktifkan data <strong id="deactivateItemName"></strong>?</p>
                <p class="text-muted text-sm" style="margin-top: 0.5rem;">
                    Data akan disembunyikan dari portal publik (Soft Delete) dan dapat dipulihkan kapan saja oleh Super Admin.
                </p>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('deactivateModal')">Batal</button>
                <form id="deactivateForm" method="POST" action="" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Nonaktifkan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- 2. Restore Modal -->
    <div class="admin-modal" id="restoreModal" aria-hidden="true" role="dialog">
        <div class="admin-modal-backdrop" onclick="closeModal('restoreModal')"></div>
        <div class="admin-modal-dialog">
            <div class="admin-modal-header">
                <h3 class="admin-modal-title">Konfirmasi Pemulihan Data</h3>
                <button type="button" class="admin-modal-close" onclick="closeModal('restoreModal')">✕</button>
            </div>
            <div class="admin-modal-body">
                <p>Apakah Anda yakin ingin memulihkan data <strong id="restoreItemName"></strong>?</p>
                <p class="text-muted text-sm" style="margin-top: 0.5rem;">
                    Data akan aktif kembali dan dapat ditampilkan di portal publik jika wilayah dusun berstatus aktif.
                </p>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('restoreModal')">Batal</button>
                <form id="restoreForm" method="POST" action="" class="inline-form">
                    @csrf
                    <button type="submit" class="btn btn-primary">Ya, Pulihkan Data</button>
                </form>
            </div>
        </div>
    </div>

    <!-- 3. Hard Delete (Hapus Permanen) Modal -->
    <div class="admin-modal" id="forceDeleteModal" aria-hidden="true" role="dialog">
        <div class="admin-modal-backdrop" onclick="closeModal('forceDeleteModal')"></div>
        <div class="admin-modal-dialog">
            <div class="admin-modal-header" style="background: #fdf2f2; border-bottom: 1px solid #f8d7da;">
                <h3 class="admin-modal-title text-danger">⚠ Konfirmasi Hapus Permanen</h3>
                <button type="button" class="admin-modal-close" onclick="closeModal('forceDeleteModal')">✕</button>
            </div>
            <div class="admin-modal-body">
                <p>PERINGATAN: Tindakan ini akan <strong>MENGHAPUS PERMANEN</strong> data <strong id="forceDeleteItemName"></strong> beserta berkas medianya dari penyimpanan.</p>
                <p class="text-danger font-semibold text-sm" style="margin-top: 0.5rem;">
                    Data yang sudah dihapus permanen TIDAK DAPAT dipulihkan kembali dengan cara apa pun!
                </p>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('forceDeleteModal')">Batal</button>
                <form id="forceDeleteForm" method="POST" action="" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Permanen Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- 4. Remove Account Modal -->
    <div class="admin-modal" id="removeAccountModal" aria-hidden="true" role="dialog">
        <div class="admin-modal-backdrop" onclick="closeModal('removeAccountModal')"></div>
        <div class="admin-modal-dialog">
            <div class="admin-modal-header">
                <h3 class="admin-modal-title">Konfirmasi Nonaktifkan Akun Admin</h3>
                <button type="button" class="admin-modal-close" onclick="closeModal('removeAccountModal')">✕</button>
            </div>
            <div class="admin-modal-body">
                <p>Apakah Anda yakin ingin menonaktifkan akun <strong id="removeAccountUsername"></strong>?</p>
                <p class="text-muted text-sm" style="margin-top: 0.5rem;">
                    Akun ini tidak akan dapat login lagi secara permanen (Logical Removal). Riwayat identitas akun tetap disimpan untuk arsip audit, dan username tidak dapat didaftarkan ulang.
                </p>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('removeAccountModal')">Batal</button>
                <form id="removeAccountForm" method="POST" action="" class="inline-form">
                    @csrf
                    <button type="submit" class="btn btn-danger">Ya, Nonaktifkan Akun</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.getElementById('menuToggleBtn');
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
        });

        function openDeactivateModal(actionUrl, itemName) {
            document.getElementById('deactivateForm').action = actionUrl;
            document.getElementById('deactivateItemName').textContent = itemName;
            document.getElementById('deactivateModal').classList.add('show');
        }

        function openRestoreModal(actionUrl, itemName) {
            document.getElementById('restoreForm').action = actionUrl;
            document.getElementById('restoreItemName').textContent = itemName;
            document.getElementById('restoreModal').classList.add('show');
        }

        function openForceDeleteModal(actionUrl, itemName) {
            document.getElementById('forceDeleteForm').action = actionUrl;
            document.getElementById('forceDeleteItemName').textContent = itemName;
            document.getElementById('forceDeleteModal').classList.add('show');
        }

        function openRemoveAccountModal(actionUrl, username) {
            document.getElementById('removeAccountForm').action = actionUrl;
            document.getElementById('removeAccountUsername').textContent = username;
            document.getElementById('removeAccountModal').classList.add('show');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
