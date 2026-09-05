@extends('layouts.public')

@section('title', $dusun->nama_dusun . ' — Portal Informasi ' . 'Desa Bendung')
@push('meta')
    <meta name="description" content="Halaman informasi publik {{ $dusun->nama_dusun }}: profil, kepala dusun, kontak pelayanan, UMKM, fasilitas, agenda, dan pengumuman.">
@endpush

@section('content')
<div class="page-dusun">

    {{-- HERO DUSUN (STICKY CINEMATIC VIEWPORT) --}}
    <header
        class="dusun-hero-story"
        id="header-dusun"
        aria-labelledby="dusun-page-title"
        @if($dusun->banner_path)
            style="--dusun-hero-image: url('{{ asset('storage/' . $dusun->banner_path) }}');"
        @endif
    >
        <div class="dusun-hero-bg" aria-hidden="true"></div>
        <div class="dusun-hero-overlay" aria-hidden="true"></div>

        <div class="container dusun-hero-topbar" data-reveal>
            <a href="{{ route('home') }}#dusun" class="dusun-hero-back">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                <span>Semua Dusun</span>
            </a>
        </div>

        {{-- HERO TITLE & DESC (FULL SCENIC VIEWPORT) --}}
        <div class="container dusun-hero-content" data-reveal>
            <span class="dusun-hero-eyebrow">PORTAL RESMI WILAYAH</span>
            <h1 class="dusun-hero-title" id="dusun-page-title">{{ $dusun->nama_dusun }}</h1>
            @if($dusun->deskripsi_singkat)
                <p class="dusun-hero-desc">{{ Str::limit($dusun->deskripsi_singkat, 220) }}</p>
            @endif
        </div>
    </header>

    {{-- FLOATING OVERLAP SHEET (SLIDES UP OVER STICKY HERO ON SCROLL) --}}
    <div class="dusun-sheet-wrapper" id="sheet-wrapper">
        <div class="container dusun-sheet-top-strip">
            <a href="#quick-nav" class="dusun-sheet-handle-wrap" id="sheet-handle-btn" aria-label="Geser ke navigasi layanan dusun">
                <span class="dusun-sheet-handle" aria-hidden="true"></span>
                <span class="dusun-hint-pulse" aria-hidden="true">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                    <span>Geser atau klik untuk navigasi & profil</span>
                </span>
            </a>
        </div>

        {{-- 1. NAVIGASI CEPAT DUSUN (GRID 4 + 3) --}}
        <section class="opt1-quicknav-section" id="quick-nav" aria-label="Navigasi Cepat Dusun">
            <div class="container">
                <div class="opt1-nav-header">
                    <span class="opt1-nav-heading">
                        <span class="opt1-nav-heading-dot"></span>
                        NAVIGASI CEPAT DUSUN
                    </span>
                </div>
                <div class="opt1-grid">
                    <a href="#profil-dusun" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <span class="opt1-label">Profil</span>
                    </a>
                    <a href="#peta-dusun" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M12 21s-6-5.333-6-10a6 6 0 0 1 12 0c0 4.667-6 10-6 10Z"/><circle cx="12" cy="11" r="2"/></svg>
                        </div>
                        <span class="opt1-label">Peta</span>
                    </a>
                    <a href="#kontak-pelayanan" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9 22v-3h6v3"/><rect x="7" y="5.5" width="3" height="2.5" rx="0.5"/><rect x="14" y="5.5" width="3" height="2.5" rx="0.5"/><rect x="7" y="10" width="3" height="2.5" rx="0.5"/><rect x="14" y="10" width="3" height="2.5" rx="0.5"/><rect x="7" y="14.5" width="3" height="2.5" rx="0.5"/><rect x="14" y="14.5" width="3" height="2.5" rx="0.5"/></svg>
                        </div>
                        <span class="opt1-label">Pelayanan</span>
                    </a>
                    <a href="#agenda" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/></svg>
                        </div>
                        <span class="opt1-label">Agenda</span>
                    </a>
                </div>
                <div class="opt1-grid-sub">
                    <a href="#umkm" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </div>
                        <span class="opt1-label">UMKM</span>
                    </a>
                    <a href="#fasilitas" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M5 21V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14M2 21h20"/><path d="M9 21v-7a3 3 0 0 1 6 0v7"/></svg>
                        </div>
                        <span class="opt1-label">Fasilitas</span>
                    </a>
                    <a href="#pengumuman" class="opt1-card">
                        <div class="opt1-iconbox">
                            <svg class="icon" viewBox="0 0 24 24"><path d="m3 11 18-5v12L3 14v-3zM11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                        </div>
                        <span class="opt1-label">Pengumuman</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- 2. PROFIL & DATA WILAYAH --}}
        <section class="opt1-profil-section" id="profil-dusun" aria-labelledby="profil-heading">
            <div class="container">
                <span class="opt1-section-badge">SELAYANG PANDANG</span>
                <h2 class="opt1-profil-title" id="profil-heading">Profil & Data Wilayah</h2>

                <!-- Leader Card -->
                <div class="opt1-leader-card">
                    <div class="opt1-leader-left">
                        <div class="opt1-leader-avatar" aria-hidden="true">
                            @if(!empty($dusun->foto_kepala_dusun_path))
                                <img src="{{ asset('storage/' . $dusun->foto_kepala_dusun_path) }}" alt="Kepala Dusun {{ $dusun->nama_dusun }}" class="opt1-leader-photo">
                            @else
                                {{ mb_substr($dusun->nama_kepala_dusun ?? $dusun->nama_dusun, 0, 1) }}
                            @endif
                        </div>
                        <div class="opt1-leader-info">
                            <small>KEPALA DUSUN {{ Str::upper(str_replace(['Dusun ', 'dusun '], '', $dusun->nama_dusun)) }}</small>
                            <strong>{{ $dusun->nama_kepala_dusun ?? 'Bapak Kadar' }}</strong>
                        </div>
                    </div>
                </div>

                @if($dusun->deskripsi_singkat)
                    <div class="opt1-story-card">
                        <div class="opt1-story-quote" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v6c0 7 2 9 3 10Z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v6c0 7 2 9 3 10Z"/></svg>
                        </div>
                        <div class="opt1-story-body">
                            <span class="opt1-story-label">Seputar Wilayah & Sejarah Dusun</span>
                            <p class="opt1-story-text">{{ $dusun->deskripsi_singkat }}</p>
                        </div>
                    </div>
                @endif

                <!-- 4 Metric Stats Grid -->
                <div class="opt1-stats-grid">
                    <div class="opt1-stat-card">
                        <div class="opt1-stat-icon" aria-hidden="true">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="opt1-stat-content">
                            <small>RUKUN TETANGGA</small>
                            <b>{{ $dusun->jumlah_rt ?? 0 }} RT</b>
                        </div>
                    </div>
                    <div class="opt1-stat-card">
                        <div class="opt1-stat-icon" aria-hidden="true">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11M8 14v4M12 14v4M16 14v4"/></svg>
                        </div>
                        <div class="opt1-stat-content">
                            <small>RUKUN WARGA</small>
                            <b>{{ $dusun->jumlah_rw ?? 0 }} RW</b>
                        </div>
                    </div>
                    <div class="opt1-stat-card">
                        <div class="opt1-stat-icon" aria-hidden="true">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M5 21V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14M2 21h20"/><path d="M9 21v-7a3 3 0 0 1 6 0v7"/></svg>
                        </div>
                        <div class="opt1-stat-content">
                            <small>FASILITAS UMUM</small>
                            <b>{{ $fasilitas->count() }} Titik</b>
                        </div>
                    </div>
                    <div class="opt1-stat-card">
                        <div class="opt1-stat-icon" aria-hidden="true">
                            <svg class="icon" viewBox="0 0 24 24"><rect width="16" height="13" x="4" y="8" rx="2.5"/><path d="M8 8V6a4 4 0 0 1 8 0v2"/></svg>
                        </div>
                        <div class="opt1-stat-content">
                            <small>UMKM AKTIF</small>
                            <b>{{ $umkms->count() }} Usaha</b>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    {{-- PETA DUSUN --}}
    <section class="section-peta" id="peta-dusun" aria-labelledby="peta-dusun-heading">
        <div class="container">
            <div class="section-head" data-reveal>
                <div>
                    <h2 class="section-title" id="peta-dusun-heading">Peta Dusun</h2>
                </div>
                <p class="section-desc">Sebaran lokasi fasilitas, UMKM, dan titik pelayanan di wilayah {{ $dusun->nama_dusun }}.</p>
            </div>

            <div class="map-card" data-reveal>
                <div class="map-toolbar">
                    <div class="field" style="grid-column: 1 / -1;">
                        <label for="map-dusun-filter-cat">Filter Kategori</label>
                        <select id="map-dusun-filter-cat" aria-label="Filter berdasarkan kategori">
                            <option value="semua">Semua Kategori</option>
                            @foreach($categoryOptions as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="map-frame">
                    <div
                        id="map-dusun"
                        data-map
                        style="height:100%;width:100%;"
                        aria-label="Peta {{ $dusun->nama_dusun }}"
                        role="img"
                    ></div>
                </div>

                <div class="map-footer">
                    <div class="map-legend">
                        <span class="legend-item"><span class="legend-dot dot-umkm" aria-hidden="true"></span>UMKM</span>
                        <span class="legend-item"><span class="legend-dot dot-service" aria-hidden="true"></span>Pelayanan</span>
                        <span class="legend-item"><span class="legend-dot dot-facility" aria-hidden="true"></span>Fasilitas</span>
                    </div>
                    <div class="caption">Peta Dusun — {{ $dusun->nama_dusun }}</div>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTAK PELAYANAN --}}
    <section class="section-kontak" id="kontak-pelayanan" aria-labelledby="kontak-pel-heading">
        <div class="container">
            <div class="section-headbar" data-reveal>
                <div>
                    <h2 class="section-title" id="kontak-pel-heading">Kontak Pelayanan</h2>
                </div>
                @if($kontaks->isNotEmpty())
                    <p class="section-note">{{ $kontaks->count() }} petugas pelayanan tersedia untuk membantu warga.</p>
                @endif
            </div>

            @if($kontaks->isEmpty())
                <x-partials.empty-state label="Belum ada kontak pelayanan yang terdaftar." />
            @else
                <div class="kontak-strip snap-strip" data-reveal role="region" tabindex="0" aria-label="Daftar petugas pelayanan, geser untuk melihat">
                    @foreach($kontaks as $k)
                        <article class="kontak-card" id="kontak-{{ $k->id }}">
                            <div class="kontak-card-top">
                                @if($k->foto_path)
                                    <img
                                        src="{{ asset('storage/' . $k->foto_path) }}"
                                        alt="Foto {{ $k->nama }}"
                                        class="kontak-card-photo"
                                        loading="lazy"
                                        width="52"
                                        height="52"
                                    >
                                @else
                                    <div class="kontak-card-photo kontak-card-photo-fallback" aria-hidden="true">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </div>
                                @endif
                                <div class="kontak-card-id">
                                    <strong class="kontak-card-name">{{ $k->nama }}</strong>
                                    <span class="kontak-card-jabatan">{{ $k->jabatan }}</span>
                                </div>
                            </div>
                            <div class="kontak-card-actions">
                                <x-partials.whatsapp-btn :nomor="$k->nomor_whatsapp" label="WhatsApp" />
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- UMKM --}}
    <section class="section-umkm" id="umkm" aria-labelledby="umkm-heading">
        <div class="container">
            <div class="section-headbar" data-reveal>
                <div>
                    <h2 class="section-title" id="umkm-heading">UMKM</h2>
                </div>
                @if($umkms->isNotEmpty())
                    <p class="section-note">{{ $umkms->count() }} usaha mikro dan menengah aktif di {{ $dusun->nama_dusun }}.</p>
                @endif
            </div>

            @if($umkms->isEmpty())
                <x-partials.empty-state label="Belum ada UMKM yang terdaftar." />
            @else
                <div class="umkm-strip snap-strip" data-reveal role="region" tabindex="0" aria-label="Daftar UMKM, geser untuk melihat">
                    @foreach($umkms as $u)
                        <article class="umkm-card" id="umkm-{{ $u->id }}" aria-label="{{ $u->nama_umkm }}">
                            <div class="umkm-card-media">
                                <x-partials.media-placeholder
                                    :src="$u->foto_utama_path"
                                    :alt="'Foto ' . $u->nama_umkm"
                                    class="umkm-card-img"
                                />
                            </div>
                            <div class="umkm-card-body">
                                <span class="umkm-card-type">{{ $u->jenis_usaha }}</span>
                                <h3 class="umkm-card-name">{{ $u->nama_umkm }}</h3>

                                @if($u->produkUmkms->isNotEmpty())
                                    <ul class="umkm-tag-list" aria-label="Produk {{ $u->nama_umkm }}">
                                        @foreach($u->produkUmkms->take(3) as $prod)
                                            <li class="umkm-tag">{{ $prod->nama_produk }}</li>
                                        @endforeach
                                        @if($u->produkUmkms->count() > 3)
                                            <li class="umkm-tag umkm-tag-more">+{{ $u->produkUmkms->count() - 3 }} lainnya</li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                            <div class="umkm-card-footer">
                                <a href="{{ route('umkm.show', $u->id) }}" class="umkm-card-link" aria-label="Lihat detail {{ $u->nama_umkm }}">
                                    Lihat Detail
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M7 17 17 7M8 7h9v9"/></svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- FASILITAS --}}
    <section class="section-fasilitas" id="fasilitas" aria-labelledby="fasilitas-heading">
        <div class="container">
            <div class="section-headbar" data-reveal>
                <div>
                    <h2 class="section-title" id="fasilitas-heading">Fasilitas</h2>
                </div>
                @if($fasilitas->isNotEmpty())
                    <p class="section-note">{{ $fasilitas->count() }} fasilitas umum tersedia di wilayah {{ $dusun->nama_dusun }}.</p>
                @endif
            </div>

            @if($fasilitas->isEmpty())
                <x-partials.empty-state label="Belum ada fasilitas yang terdaftar." />
            @else
                <div class="fasilitas-strip snap-strip" data-reveal role="region" tabindex="0" aria-label="Daftar fasilitas, geser untuk melihat">
                    @foreach($fasilitas as $f)
                        <article class="facility-card" id="fasilitas-{{ $f->id }}">
                            <div class="facility-card-media">
                                <x-partials.media-placeholder
                                    :src="$f->foto_path"
                                    :alt="'Foto ' . $f->nama"
                                    class="facility-card-img"
                                />
                                @if($f->kategoriFasilitas?->nama_kategori)
                                    <span class="facility-badge-float">{{ $f->kategoriFasilitas->nama_kategori }}</span>
                                @endif
                            </div>
                            <div class="facility-card-body">
                                <h3 class="facility-card-name">{{ $f->nama }}</h3>
                                @if($f->alamat)
                                    <p class="facility-card-addr">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $f->alamat }}</span>
                                    </p>
                                @endif
                            </div>
                            <div class="facility-card-footer">
                                <a href="{{ route('fasilitas.show', $f->id) }}" class="facility-card-link" aria-label="Lihat detail {{ $f->nama }}">
                                    <span>Lihat Detail</span>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M7 17 17 7M8 7h9v9"/></svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- INFORMASI TERKINI --}}
    <section class="section-terkini" aria-labelledby="terkini-heading">
        <div class="container">
            <div class="section-head" data-reveal>
                <h2 class="section-title" id="terkini-heading">Informasi Terkini</h2>
            </div>

            <div class="terkini-grid">
                <div class="terkini-col" id="agenda" aria-labelledby="agenda-dusun-heading">
                    <div class="section-head">
                        <h3 class="terkini-col-title" id="agenda-dusun-heading">Agenda &amp; Kegiatan</h3>
                    </div>

                    @if($agendas->isEmpty())
                        <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
                    @else
                        <div class="timeline" data-reveal>
                            @foreach($agendas as $ag)
                                @php
                                    $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                                    $status = $ag->effectiveStatusFor($now);
                                    $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                                @endphp
                                <article class="timeline-item" id="agenda-{{ $ag->id }}">
                                    <div class="timeline-icon green" aria-hidden="true">📅</div>
                                    <div>
                                        <div class="meta">
                                            <span class="date">{{ $startDate->isoFormat('D MMM') }}</span>
                                            <x-partials.status-badge :status="$status" />
                                            @if($ag->lokasi_text)
                                                <span class="subtle">{{ $ag->lokasi_text }}</span>
                                            @endif
                                        </div>
                                        <h4 class="item-title">
                                            <a href="{{ route('agenda.show', $ag->id) }}">{{ $ag->judul }}</a>
                                        </h4>
                                    </div>
                                    <a href="{{ route('agenda.show', $ag->id) }}" class="arrow" aria-label="Detail agenda: {{ $ag->judul }}">›</a>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="terkini-col" id="pengumuman" aria-labelledby="pengumuman-dusun-heading">
                    <div class="section-head">
                        <h3 class="terkini-col-title" id="pengumuman-dusun-heading">Pengumuman</h3>
                        <a href="{{ route('pengumuman.arsip', ['dusun' => $dusun->id]) }}" class="see-all" aria-label="Lihat arsip pengumuman {{ $dusun->nama_dusun }}">
                            Lihat Semua →
                        </a>
                    </div>

                    @if($pengumumans->isEmpty())
                        <x-partials.empty-state label="Belum ada pengumuman aktif." />
                    @else
                        <div class="timeline" data-reveal>
                            @foreach($pengumumans as $p)
                                @php $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); @endphp
                                <article class="timeline-item" id="pengumuman-{{ $p->id }}">
                                    <div class="timeline-icon" aria-hidden="true">📣</div>
                                    <div>
                                        <div class="meta">
                                            <span class="date">{{ $pDate->isoFormat('D MMM YYYY') }}</span>
                                            <span class="badge">Warta Resmi</span>
                                            @if($p->tanggal_kedaluwarsa)
                                                <span class="subtle">s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                            @endif
                                        </div>
                                        <h4 class="item-title">
                                            <a href="{{ route('pengumuman.show', $p->id) }}">{{ $p->judul }}</a>
                                        </h4>
                                    </div>
                                    <a href="{{ route('pengumuman.show', $p->id) }}" class="arrow" aria-label="Baca pengumuman: {{ $p->judul }}">›</a>
                                </article>
                            @endforeach
                        </div>
                        <a class="outline-btn" href="{{ route('pengumuman.arsip', ['dusun' => $dusun->id]) }}">Lihat Semua Pengumuman</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    </div> {{-- End .dusun-sheet-wrapper --}}

</div>
@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};
    // map.js automatically initializes every [data-map] element on DOMContentLoaded.

    // Smooth handle click to reveal sheet
    document.addEventListener('DOMContentLoaded', function () {
        var handleBtn = document.getElementById('sheet-handle-btn');
        if (handleBtn) {
            handleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                var target = document.getElementById('quick-nav') || document.getElementById('sheet-dusun');
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }
    });
</script>
@endpush