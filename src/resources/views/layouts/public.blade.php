<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Portal Informasi Desa Bendung')</title>
    <meta name="description" content="@yield('description', 'Portal informasi publik Desa Bendung — profil desa, dusun, UMKM, fasilitas, agenda, dan pengumuman.')">

    @stack('meta')

    {{-- Public redesign typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap">

    {{-- app.css remains for legacy/shared styles; public.css is the public visual authority --}}
    @vite(['resources/css/app.css', 'resources/css/public.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="public-layout">

    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>

    <header class="public-header" role="banner">
        <div class="container">
            <div class="public-header-inner">

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
                                <path d="M12 22V8"/>
                                <path d="M7 13c-3-1-4.5-3.5-4-7 4 .5 6.5 3 6 7"/>
                                <path d="M13 16c5-.5 8-3.5 8-8-5 .5-8 3.5-8 8"/>
                                <path d="M5 21h14"/>
                            </svg>
                        </div>
                    @endif
                    <span class="public-brand-text">
                        <span class="public-brand-name">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</span>
                        <span class="public-brand-sub">Portal Informasi</span>
                    </span>
                </a>

                <nav aria-label="Navigasi utama" class="public-nav" id="desktop-nav">
                    <ul class="public-nav-list">
                        <li><a href="{{ route('home') }}" class="public-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                        <li><a href="{{ route('home') }}#dusun" class="public-nav-link {{ request()->routeIs('dusun.show') ? 'active' : '' }}">Dusun</a></li>
                        <li><a href="{{ route('home') }}#informasi-desa" class="public-nav-link">Informasi</a></li>
                        <li><a href="{{ route('home') }}#pengumuman" class="public-nav-link">Pengumuman</a></li>
                        <li><a href="{{ route('home') }}#agenda" class="public-nav-link">Agenda</a></li>
                        <li><a href="{{ route('home') }}#peta-desa" class="public-nav-link">Peta</a></li>
                        <li><a href="{{ request()->routeIs('dusun.show') ? '#kontak-pelayanan' : route('home') . '#kontak-desa' }}" class="public-nav-link">Kontak</a></li>
                    </ul>
                </nav>

                <a
                    href="{{ request()->routeIs('dusun.show') ? '#kontak-pelayanan' : route('home') . '#kontak-desa' }}"
                    class="header-cta"
                    aria-label="Hubungi Pelayanan"
                >
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span>Hubungi Pelayanan</span>
                </a>

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

            <nav id="mobile-nav" class="mobile-nav" aria-label="Navigasi mobile">
                <ul class="mobile-nav-list-mobile">
                    <li><a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a></li>
                    <li><a href="{{ route('home') }}#dusun" class="mobile-nav-link">Dusun</a></li>
                    <li><a href="{{ route('home') }}#informasi-desa" class="mobile-nav-link">Informasi Desa</a></li>
                    <li><a href="{{ route('home') }}#pengumuman" class="mobile-nav-link">Pengumuman</a></li>
                    <li><a href="{{ route('home') }}#agenda" class="mobile-nav-link">Agenda Kegiatan</a></li>
                    <li><a href="{{ request()->routeIs('dusun.show') ? '#peta-dusun' : route('home') . '#peta-desa' }}" class="mobile-nav-link">Peta</a></li>
                    <li><a href="{{ request()->routeIs('dusun.show') ? '#kontak-pelayanan' : route('home') . '#kontak-desa' }}" class="mobile-nav-link">Kontak & Pelayanan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main-content" class="public-main" role="main">
        @yield('content')
    </main>

    <footer class="public-footer" role="contentinfo">
        <div class="container">
            <div class="public-footer-inner">
                <div class="footer-brand">
                    <div class="footer-brand-header">
                        @if($desa?->logo_path)
                            <img
                                src="{{ asset('storage/' . $desa->logo_path) }}"
                                alt="Logo {{ $desa->nama_desa }}"
                                class="footer-brand-logo"
                                width="34"
                                height="42"
                            >
                        @endif
                        <div>
                            <span class="footer-brand-badge">PEMERINTAH DESA</span>
                            <h2 class="footer-brand-name">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</h2>
                        </div>
                    </div>
                    <p class="footer-brand-tagline">Portal informasi publik Desa dan Dusun.</p>

                    @if($desa?->alamat_kantor)
                        <p class="footer-address">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>{{ $desa->alamat_kantor }}</span>
                        </p>
                    @endif

                    @if($desa?->nomor_kontak)
                        <p class="footer-address">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72"/></svg>
                            <span>{{ $desa->nomor_kontak }}</span>
                        </p>
                    @endif
                </div>

                <div class="footer-nav-wrap">
                    <p class="footer-nav-title">Navigasi Cepat</p>
                    <nav aria-label="Navigasi footer">
                        <ul class="footer-nav">
                            <li><a href="{{ route('home') }}">Beranda</a></li>
                            <li><a href="{{ route('home') }}#dusun">Dusun</a></li>
                            <li><a href="{{ route('home') }}#informasi-desa">Informasi</a></li>
                            <li><a href="{{ route('home') }}#pengumuman">Pengumuman</a></li>
                            <li><a href="{{ route('home') }}#agenda">Agenda</a></li>
                            <li><a href="{{ route('home') }}#peta-desa">Peta</a></li>
                            <li><a href="{{ route('home') }}#kontak-desa">Kontak</a></li>
                            <li><a href="{{ route('admin.login') }}" class="footer-login-link">Portal Admin →</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} Portal Informasi {{ $desa?->nama_desa ?? 'Desa Bendung' }}.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>