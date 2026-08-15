<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Portal Informasi Desa Bendung')</title>
    <meta name="description" content="@yield('description', 'Portal informasi publik Desa Bendung — profil desa, dusun, UMKM, fasilitas, agenda, dan pengumuman.')">

    @stack('meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="public-layout">

    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>

    {{-- ================================================================
         PUBLIC HEADER
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
                            width="40"
                            height="40"
                        >
                    @else
                        <div class="public-brand-logo" style="background:var(--color-moss);display:flex;align-items:center;justify-content:center;" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#faf7f2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                    @endif
                    <span class="public-brand-text">
                        <span class="public-brand-name">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</span>
                        <span class="public-brand-sub">Portal Informasi</span>
                    </span>
                </a>

                {{-- Desktop navigation --}}
                <nav aria-label="Navigasi utama" class="public-nav" id="desktop-nav">
                    <ul class="public-nav">
                        <li><a href="{{ route('home') }}" class="public-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                        <li><a href="{{ route('home') }}#dusun" class="public-nav-link">Dusun</a></li>
                        <li><a href="{{ route('home') }}#informasi-desa" class="public-nav-link">Informasi</a></li>
                        <li><a href="{{ route('home') }}#pengumuman" class="public-nav-link">Pengumuman</a></li>
                        <li><a href="{{ route('home') }}#agenda" class="public-nav-link">Agenda</a></li>
                        <li><a href="{{ route('home') }}#peta-desa" class="public-nav-link">Peta</a></li>
                        <li><a href="{{ route('home') }}#kontak-desa" class="public-nav-link">Kontak</a></li>
                    </ul>
                </nav>

                {{-- Mobile menu button --}}
                <button
                    id="mobile-menu-toggle"
                    class="mobile-menu-btn"
                    aria-label="Buka menu navigasi"
                    aria-expanded="false"
                    aria-controls="mobile-nav"
                    type="button"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>

            {{-- Mobile navigation drawer --}}
            <nav id="mobile-nav" class="mobile-nav" aria-label="Navigasi mobile">
                <ul class="mobile-nav-list">
                    <li><a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a></li>
                    <li><a href="{{ route('home') }}#dusun" class="mobile-nav-link">Dusun</a></li>
                    <li><a href="{{ route('home') }}#informasi-desa" class="mobile-nav-link">Informasi</a></li>
                    <li><a href="{{ route('home') }}#pengumuman" class="mobile-nav-link">Pengumuman</a></li>
                    <li><a href="{{ route('home') }}#agenda" class="mobile-nav-link">Agenda</a></li>
                    <li><a href="{{ route('home') }}#peta-desa" class="mobile-nav-link">Peta</a></li>
                    <li><a href="{{ route('home') }}#kontak-desa" class="mobile-nav-link">Kontak</a></li>
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
         PUBLIC FOOTER
         ================================================================ --}}
    <footer class="public-footer" role="contentinfo">
        <div class="container">
            <div class="public-footer-inner">

                {{-- Brand block --}}
                <div class="footer-brand">
                    <h2 class="footer-brand-name">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</h2>
                    <p class="footer-brand-tagline">Informasi publik Desa dan Dusun</p>
                    @if($desa?->alamat_kantor)
                        <p style="color:var(--color-warm-beige);font-size:0.8125rem;margin-top:var(--space-1);">{{ $desa->alamat_kantor }}</p>
                    @endif
                    @if($desa?->nomor_kontak)
                        <p style="color:var(--color-warm-beige);font-size:0.8125rem;">{{ $desa->nomor_kontak }}</p>
                    @endif
                </div>

                {{-- Footer navigation --}}
                <nav aria-label="Navigasi footer">
                    <ul class="footer-nav">
                        <li><a href="{{ route('home') }}" class="footer-nav-link">Beranda</a></li>
                        <li><a href="{{ route('home') }}#dusun" class="footer-nav-link">Dusun</a></li>
                        <li><a href="{{ route('home') }}#informasi-desa" class="footer-nav-link">Informasi</a></li>
                        <li><a href="{{ route('home') }}#pengumuman" class="footer-nav-link">Pengumuman</a></li>
                        <li><a href="{{ route('home') }}#agenda" class="footer-nav-link">Agenda</a></li>
                        <li><a href="{{ route('home') }}#peta-desa" class="footer-nav-link">Peta</a></li>
                        <li><a href="{{ route('home') }}#kontak-desa" class="footer-nav-link">Kontak</a></li>
                        <li><a href="{{ route('admin.login') }}" class="footer-nav-link" style="opacity:0.6;">Login Admin</a></li>
                    </ul>
                </nav>

            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} Portal Informasi {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Dikembangkan oleh Tim KKN.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>
