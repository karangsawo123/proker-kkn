<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Portal Informasi Desa Bendung')</title>
    <meta name="description" content="@yield('description', 'Portal informasi publik Desa Bendung — profil desa, dusun, UMKM, fasilitas, agenda, dan pengumuman.')">

    @stack('meta')

    {{-- Google Fonts: Playfair Display (gazette display serif) + Plus Jakarta Sans (clean modern UI) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="public-layout">

    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>

    {{-- ================================================================
         PUBLIC HEADER — Warm Natural, Sticky with Glassmorphism
         ================================================================ --}}
    <header class="public-header" role="banner">
        <div class="container">
            <div class="public-header-inner">

                {{-- Brand --}}
                <a href="{{ route('home') }}" class="public-brand" aria-label="Beranda Portal Informasi {{ $desa?->nama_desa ?? 'Desa Bendung' }}">
                    @if($desa?->logo_path)
                        <img
                            src="{{ asset('storage/' . $desa->logo_path) }}"
                            alt="Logo {{ $desa->nama_desa }}"
                            class="public-brand-logo"
                            width="42"
                            height="42"
                        >
                    @else
                        <div class="public-brand-logo brand-logo-placeholder" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                    @endif
                    <span class="public-brand-text">
                        <span class="public-brand-name">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</span>
                        <span class="public-brand-sub">Portal Informasi Resmi</span>
                    </span>
                </a>

                {{-- Desktop navigation --}}
                <nav aria-label="Navigasi utama" class="public-nav" id="desktop-nav">
                    <ul class="public-nav-list">
                        <li><a href="{{ route('home') }}" class="public-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                        <li><a href="{{ route('home') }}#dusun" class="public-nav-link">Dusun</a></li>
                        <li><a href="{{ route('home') }}#informasi-desa" class="public-nav-link">Informasi</a></li>
                        <li><a href="{{ route('home') }}#pengumuman" class="public-nav-link">Pengumuman</a></li>
                        <li><a href="{{ route('home') }}#agenda" class="public-nav-link">Agenda</a></li>
                        <li><a href="{{ route('home') }}#peta-desa" class="public-nav-link">Peta</a></li>
                        <li><a href="{{ route('home') }}#kontak-desa" class="public-nav-link">Kontak</a></li>
                    </ul>
                </nav>

                {{-- Header CTA (desktop only) --}}
                <a href="{{ route('home') }}#kontak-desa" class="header-cta" aria-label="Hubungi Pelayanan Desa">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>Layanan Publik</span>
                </a>

                {{-- Mobile menu button --}}
                <button
                    id="mobile-menu-toggle"
                    class="mobile-menu-btn"
                    aria-label="Buka menu navigasi"
                    aria-expanded="false"
                    aria-controls="mobile-nav"
                    type="button"
                >
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>

            </div>

            {{-- Mobile navigation drawer --}}
            <nav id="mobile-nav" class="mobile-nav" aria-label="Navigasi mobile">
                <ul class="mobile-nav-list-mobile">
                    <li><a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a></li>
                    <li><a href="{{ route('home') }}#dusun" class="mobile-nav-link">Dusun</a></li>
                    <li><a href="{{ route('home') }}#informasi-desa" class="mobile-nav-link">Informasi Desa</a></li>
                    <li><a href="{{ route('home') }}#pengumuman" class="mobile-nav-link">Pengumuman</a></li>
                    <li><a href="{{ route('home') }}#agenda" class="mobile-nav-link">Agenda Kegiatan</a></li>
                    <li><a href="{{ route('home') }}#peta-desa" class="mobile-nav-link">Peta Lokasi</a></li>
                    <li><a href="{{ route('home') }}#kontak-desa" class="mobile-nav-link">Kontak & Pelayanan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    {{-- ================================================================
         MAIN CONTENT
         ================================================================ --}}
    <main id="main-content" class="public-main" role="main">
        @yield('content')
    </main>

    {{-- ================================================================
         PUBLIC FOOTER — Forest Heritage Dark
         ================================================================ --}}
    <footer class="public-footer" role="contentinfo">
        <div class="container">
            <div class="public-footer-inner">

                {{-- Brand block --}}
                <div class="footer-brand">
                    <div class="footer-brand-header">
                        <span class="footer-brand-badge">PEMERINTAH DESA</span>
                        <h2 class="footer-brand-name">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</h2>
                    </div>
                    <p class="footer-brand-tagline">Pusat informasi publik terpadu, potensi wilayah, dan pelayanan masyarakat.</p>
                    @if($desa?->alamat_kantor)
                        <p class="footer-address">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>{{ $desa->alamat_kantor }}</span>
                        </p>
                    @endif
                    @if($desa?->nomor_kontak)
                        <p class="footer-address">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>{{ $desa->nomor_kontak }}</span>
                        </p>
                    @endif
                </div>

                {{-- Footer navigation --}}
                <div class="footer-nav-wrap">
                    <p class="footer-nav-title">Navigasi Cepat</p>
                    <nav aria-label="Navigasi footer">
                        <ul class="footer-nav">
                            <li><a href="{{ route('home') }}" class="footer-nav-link">Beranda</a></li>
                            <li><a href="{{ route('home') }}#dusun" class="footer-nav-link">Pilihan Dusun</a></li>
                            <li><a href="{{ route('home') }}#informasi-desa" class="footer-nav-link">Informasi Desa</a></li>
                            <li><a href="{{ route('home') }}#pengumuman" class="footer-nav-link">Pengumuman</a></li>
                            <li><a href="{{ route('home') }}#agenda" class="footer-nav-link">Agenda Kegiatan</a></li>
                            <li><a href="{{ route('home') }}#peta-desa" class="footer-nav-link">Peta Lokasi</a></li>
                            <li><a href="{{ route('home') }}#kontak-desa" class="footer-nav-link">Kontak Pelayanan</a></li>
                            <li><a href="{{ route('admin.login') }}" class="footer-nav-link footer-login-link">Portal Admin &rarr;</a></li>
                        </ul>
                    </nav>
                </div>

            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} Portal Informasi {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>
