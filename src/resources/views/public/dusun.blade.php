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
            <span class="dusun-hero-chip">Desa Bendung</span>
        </div>

        <div class="container dusun-hero-center-badge" data-reveal>
            <span class="dusun-badge-potensi-hero">Sentra Pertanian & UMKM</span>
        </div>
    </header>

    {{-- FLOATING OVERLAP SHEET (SLIDES UP OVER STICKY HERO ON SCROLL) --}}
    <div class="dusun-sheet-wrapper" id="sheet-wrapper">
        <div class="dusun-floating-sheet" id="sheet-dusun" data-reveal>
            <div class="container">
                <a href="#quick-nav" class="dusun-sheet-handle-wrap" id="sheet-handle-btn" aria-label="Geser ke navigasi layanan dusun">
                    <span class="dusun-sheet-handle" aria-hidden="true"></span>
                    <span class="dusun-hint-pulse" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                        <span>Geser atau klik untuk layanan & profil</span>
                    </span>
                </a>

                <div class="dusun-title-row">
                    <h1 class="dusun-hero-title" id="dusun-page-title">{{ $dusun->nama_dusun }}</h1>
                    <span class="dusun-badge-potensi">Sentra Pertanian & UMKM</span>
                </div>

                @if($dusun->deskripsi_singkat)
                    <p class="dusun-hero-desc">{{ Str::limit($dusun->deskripsi_singkat, 200) }}</p>
                @endif

                {{-- FAST GLANCE METRIC STRIP --}}
                <div class="dusun-fast-strip" role="region" aria-label="Ringkasan Wilayah">
                    <div class="dusun-fast-item">
                        <span>Rukun Tetangga</span>
                        <strong>{{ $dusun->jumlah_rt ?? 0 }} RT</strong>
                    </div>
                    <div class="dusun-fast-div" aria-hidden="true"></div>
                    <div class="dusun-fast-item">
                        <span>Rukun Warga</span>
                        <strong>{{ $dusun->jumlah_rw ?? 0 }} RW</strong>
                    </div>
                    <div class="dusun-fast-div" aria-hidden="true"></div>
                    <div class="dusun-fast-item">
                        <span>Fasilitas Umum</span>
                        <strong>{{ $fasilitas->count() }} Titik</strong>
                    </div>
                    <div class="dusun-fast-div" aria-hidden="true"></div>
                    <div class="dusun-fast-item">
                        <span>UMKM Warga</span>
                        <strong>{{ $umkms->count() }} Usaha</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- QUICK NAVIGATION (ACTION HUB WITH DATA COUNTS) --}}
        <nav class="dusun-action-hub" id="quick-nav" aria-label="Navigasi cepat halaman {{ $dusun->nama_dusun }}">
            <div class="container">
                <div class="dusun-hub-header">
                    <span class="dusun-hub-label">Layanan & Direktori Dusun</span>
                </div>
                <div class="dusun-hub-grid" role="list">
                    <a href="#profil-dusun" class="dusun-hub-card highlight" role="listitem">
                        <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Profil Dusun</strong>
                    </div>
                </a>

                <a href="#peta-dusun" class="dusun-hub-card" role="listitem">
                    <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-6-5.333-6-10a6 6 0 0 1 12 0c0 4.667-6 10-6 10Z"/><circle cx="12" cy="11" r="2"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Peta Dusun</strong>
                    </div>
                </a>

                <a href="#kontak-pelayanan" class="dusun-hub-card" role="listitem">
                    <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9 22v-4h6v4"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Pelayanan</strong>
                    </div>
                    @if($kontaks->count() > 0)
                        <span class="dusun-hub-count">{{ $kontaks->count() }}</span>
                    @endif
                </a>

                <a href="#agenda" class="dusun-hub-card" role="listitem">
                    <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Agenda</strong>
                    </div>
                    @if($agendas->count() > 0)
                        <span class="dusun-hub-count">{{ $agendas->count() }}</span>
                    @endif
                </a>

                <a href="#umkm" class="dusun-hub-card" role="listitem">
                    <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Sentra UMKM</strong>
                    </div>
                    <span class="dusun-hub-count">{{ $umkms->count() }}</span>
                </a>

                <a href="#fasilitas" class="dusun-hub-card" role="listitem">
                    <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V6a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14"/><path d="M2 20h20"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Fasilitas</strong>
                    </div>
                    <span class="dusun-hub-count">{{ $fasilitas->count() }}</span>
                </a>

                <a href="#pengumuman" class="dusun-hub-card dusun-hub-card-wide" role="listitem">
                    <div class="dusun-hub-left">
                        <span class="dusun-hub-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 14v-3z"/></svg>
                        </span>
                        <strong class="dusun-hub-text">Warta & Pengumuman</strong>
                    </div>
                    <span class="dusun-hub-count {{ $pengumumans->count() > 0 ? 'badge-active' : '' }}">
                        {{ $pengumumans->count() > 0 ? $pengumumans->count() . ' Aktif' : '0' }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    {{-- PROFIL DUSUN (BENTO PAMONG & WILAYAH) --}}
    <section class="section-tentang dusun-profil-bento" id="profil-dusun" aria-labelledby="profil-heading">
        <div class="container">
            <div class="dusun-bento-card" data-reveal>
                <div class="dusun-bento-header">
                    <span class="dusun-bento-mark" aria-hidden="true"></span>
                    <h2 id="profil-heading">Kepala Dusun & Pamong Wilayah</h2>
                </div>

                @if($dusun->nama_kepala_dusun)
                    <div class="dusun-dukuh-bento">
                        <div class="dusun-dukuh-left">
                            <div class="dusun-dukuh-avatar" aria-hidden="true">
                                {{ mb_substr($dusun->nama_kepala_dusun, 0, 1) }}
                            </div>
                            <div class="dusun-dukuh-meta">
                                <small>Kepala Dusun {{ $dusun->nama_dusun }}</small>
                                <strong>{{ $dusun->nama_kepala_dusun }}</strong>
                                <span class="dusun-dukuh-badge">Masa Bakti Aktif</span>
                            </div>
                        </div>
                        <a href="#kontak-pelayanan" class="dusun-dukuh-action">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>Kontak Pelayanan</span>
                        </a>
                    </div>
                @endif
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
                                <option value="{{ e($cat) }}">{{ $cat }}</option>
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
                                <a href="{{ route('fasilitas.show', $f->id) }}" class="facility-card-link" aria-label="Lihat lokasi {{ $f->nama }}">
                                    <span>Lihat Lokasi</span>
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