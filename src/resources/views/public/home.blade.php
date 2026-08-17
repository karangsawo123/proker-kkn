@extends('layouts.public')

@section('title', ($desa?->nama_desa ?? 'Desa Bendung') . ' — Portal Informasi')
@push('meta')
    <meta name="description" content="Portal informasi publik {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Temukan profil desa, dusun aktif, UMKM, fasilitas, agenda kegiatan, pengumuman, dan peta lokasi.">
@endpush

@section('content')
<div class="page-home">

{{-- ============================================================
     UX-SCR-001 | HERO / IDENTITAS DESA (Gazette Masthead)
     ============================================================ --}}
<section
    class="hero{{ !($desa?->banner_path) ? ' hero-fallback' : '' }}"
    id="beranda"
    aria-labelledby="hero-heading"
>
    <div class="hero-body">
        <div class="container">
            <div class="hero-lockup" data-reveal>
                <h1 class="hero-title" id="hero-heading">
                    {{ $desa?->nama_desa ?? 'Desa Bendung' }}
                </h1>

                <div class="hero-lede-row">
                    <p class="hero-desc">
                        {{ $desa?->deskripsi_singkat ?? 'Pusat informasi terpadu profil desa, potensi dusun, pelayanan masyarakat, fasilitas, dan kegiatan warga dalam satu portal resmi.' }}
                    </p>

                    <div class="hero-actions">
                        <a href="#dusun" class="hero-btn hero-btn-primary">
                            Jelajahi Potensi Dusun
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                        </a>
                        <a href="#peta-desa" class="hero-btn hero-btn-text">
                            Lihat Peta Wilayah
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            @if($desa?->banner_path)
                <figure class="hero-plate" data-reveal>
                    <span class="hero-plate-frame" aria-hidden="true"></span>
                    <img
                        src="{{ asset('storage/' . $desa->banner_path) }}"
                        alt="Dokumentasi wilayah {{ $desa->nama_desa }}"
                        class="hero-plate-img"
                        fetchpriority="high"
                    >
                    <figcaption class="hero-plate-caption">
                        <span class="hero-plate-caption-rule" aria-hidden="true"></span>
                        Dokumentasi wilayah {{ $desa->nama_desa }}
                    </figcaption>
                </figure>
            @endif
        </div>
    </div>
</section>

{{-- ============================================================
     Indeks Cepat — gazette table of contents below hero
     ============================================================ --}}
<nav class="index-bar" aria-label="Indeks cepat halaman">
    <div class="container">
        <div class="index-bar-inner">
            <span class="index-bar-label">Indeks</span>
            <ul class="index-bar-list">
                <li><a href="#dusun"><span class="index-num">01</span>Pilihan Dusun</a></li>
                <li><a href="#informasi-desa"><span class="index-num">02</span>Informasi Desa</a></li>
                <li><a href="#pengumuman"><span class="index-num">03</span>Pengumuman</a></li>
                <li><a href="#agenda"><span class="index-num">04</span>Agenda Kegiatan</a></li>
                <li><a href="#peta-desa"><span class="index-num">05</span>Peta Wilayah</a></li>
                <li><a href="#kontak-desa"><span class="index-num">06</span>Kontak Pelayanan</a></li>
            </ul>
        </div>
    </div>
</nav>

{{-- ============================================================
     UX-SCR-001 | SECTION: Pilihan Dusun (Dinding Dusun — honor roll)
     ============================================================ --}}
<section class="section-dusun" id="dusun" aria-labelledby="dusun-heading">
    <div class="container">
        <div class="dusun-wall-head" data-reveal>
            <div>
                <div class="section-badge section-badge-dark" aria-hidden="true">Wilayah Administratif</div>
                <h2 class="section-title dusun-wall-title" id="dusun-heading">Pilihan Dusun</h2>
            </div>
            <p class="dusun-wall-note">Eksplorasi potensi dan profil dari {{ $dusuns->count() }} dusun aktif di wilayah {{ $desa?->nama_desa ?? 'Desa Bendung' }}.</p>
        </div>

        @if($dusuns->isEmpty())
            <x-partials.empty-state label="Belum ada Dusun aktif yang terdaftar." />
        @else
            <div class="dusun-wall" data-reveal>
                @foreach($dusuns as $index => $dusun)
                    <a href="{{ route('dusun.show', $dusun->id) }}" class="dusun-wall-row" id="dusun-card-{{ $dusun->id }}">
                        <span class="dusun-wall-num" aria-hidden="true">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="dusun-wall-name">{{ $dusun->nama_dusun }}</span>
                        <span class="dusun-wall-cta">Buka Profil
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION: Informasi Desa (Editorial Spread)
     ============================================================ --}}
<section class="section-info-desa" id="informasi-desa" aria-labelledby="info-desa-heading">
    <div class="container">
        <div class="info-spread">

            {{-- Kolom Kiri: Tentang Desa --}}
            <div class="info-lead" data-reveal>
                <div class="section-badge" aria-hidden="true">Identitas &amp; Layanan</div>
                <h2 class="section-title" id="info-desa-heading">Informasi Desa</h2>

                <div class="info-lead-body">
                    @if($desa?->deskripsi_singkat)
                        <p>{{ $desa->deskripsi_singkat }}</p>
                    @else
                        <p class="text-muted">Deskripsi dan profil resmi desa ditampilkan di sini.</p>
                    @endif
                </div>

                @if($desa?->nama_kepala_desa)
                    <div class="info-kades">
                        <span class="info-kades-label">Kepala Desa</span>
                        <strong class="info-kades-name">{{ $desa->nama_kepala_desa }}</strong>
                    </div>
                @endif
            </div>

            {{-- Kolom Kanan: Fakta Pelayanan --}}
            <div class="info-facts" data-reveal>
                <h3 class="info-facts-title">Fakta Pelayanan</h3>
                <dl class="info-facts-list">
                    @if($desa?->alamat_kantor)
                        <div class="info-fact">
                            <dt>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Alamat Kantor</span>
                            </dt>
                            <dd>{{ $desa->alamat_kantor }}</dd>
                        </div>
                    @endif

                    @if($desa?->jam_pelayanan)
                        <div class="info-fact">
                            <dt>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span>Jam Operasional</span>
                            </dt>
                            <dd>{{ $desa->jam_pelayanan }}</dd>
                        </div>
                    @endif

                    @if($desa?->nomor_kontak)
                        <div class="info-fact">
                            <dt>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <span>WhatsApp &amp; Telepon</span>
                            </dt>
                            <dd>{{ $desa->nomor_kontak }}</dd>
                        </div>
                    @endif

                    @if($desa?->email)
                        <div class="info-fact">
                            <dt>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <span>Email Resmi</span>
                            </dt>
                            <dd>{{ $desa->email }}</dd>
                        </div>
                    @endif

                    @if(!$desa?->alamat_kantor && !$desa?->jam_pelayanan && !$desa?->nomor_kontak && !$desa?->email)
                        <p class="text-muted">Informasi pelayanan desa belum tersedia.</p>
                    @endif
                </dl>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION: Pengumuman Terbaru (Warta Ledger)
     ============================================================ --}}
<section class="section-pengumuman" id="pengumuman" aria-labelledby="pengumuman-heading">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-badge" aria-hidden="true">Warta &amp; Pemberitahuan</div>
                <h2 class="section-title" id="pengumuman-heading">Pengumuman Terbaru</h2>
            </div>
            <a href="{{ route('pengumuman.arsip') }}" class="arsip-link" aria-label="Lihat semua arsip pengumuman desa">
                <span>Lihat Semua Arsip</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($pengumumans->isEmpty())
            <x-partials.empty-state label="Belum ada pengumuman aktif." />
        @else
            <ul class="notice-list" data-reveal>
                @foreach($pengumumans as $p)
                    @php $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); @endphp
                    <li class="notice-row">
                        <time class="notice-date" datetime="{{ $p->created_at->toDateString() }}">
                            <span class="notice-date-day">{{ $pDate->format('d') }}</span>
                            <span class="notice-date-month">{{ $pDate->isoFormat('MMM') }}</span>
                            <span class="notice-date-year">{{ $pDate->format('Y') }}</span>
                        </time>

                        <div class="notice-main">
                            <div class="notice-meta">
                                <span class="notice-chip">Warta Resmi</span>
                                <span class="notice-expiry">Berlaku s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                            </div>
                            <h3 class="notice-title">
                                <a href="{{ route('pengumuman.show', $p->id) }}" class="notice-title-link">
                                    {{ $p->judul }}
                                </a>
                            </h3>
                        </div>

                        <a href="{{ route('pengumuman.show', $p->id) }}" class="notice-arrow" aria-label="Baca pengumuman: {{ $p->judul }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION: Agenda & Kegiatan Terbaru (Sorotan + Ledger)
     ============================================================ --}}
<section class="section-agenda" id="agenda" aria-labelledby="agenda-heading">
    <div class="container">
        <div class="section-headbar">
            <div>
                <div class="section-badge" aria-hidden="true">Jadwal &amp; Kegiatan Warga</div>
                <h2 class="section-title" id="agenda-heading">Agenda &amp; Kegiatan</h2>
            </div>
            <p class="section-note">Ikuti berbagai kegiatan kemasyarakatan, pertemuan dusun, dan agenda pembangunan desa.</p>
        </div>

        @if($agendas->isEmpty())
            <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
        @else
            <div class="agenda-ledger" data-reveal>
                @foreach($agendas as $ag)
                    @php
                        $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                        $status = $ag->effectiveStatusFor($now);
                        $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                    @endphp

                    @if($loop->first)
                        <article class="agenda-feature" aria-label="{{ $ag->judul }}">
                            <div class="agenda-feature-date">
                                <span class="agenda-feature-day">{{ $startDate->format('d') }}</span>
                                <span class="agenda-feature-month">{{ $startDate->isoFormat('MMM') }}</span>
                                <span class="agenda-feature-year">{{ $startDate->format('Y') }}</span>
                            </div>

                            <div class="agenda-feature-body">
                                <div class="agenda-feature-head">
                                    <x-partials.status-badge :status="$status" />
                                    <span class="agenda-scope">Agenda Desa</span>
                                </div>

                                <h3 class="agenda-feature-title">
                                    <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-feature-title-link">
                                        {{ $ag->judul }}
                                    </a>
                                </h3>

                                <div class="agenda-meta">
                                    <div class="agenda-meta-row">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        <span>
                                            {{ $startDate->isoFormat('D MMM YYYY') }}
                                            @if($ag->tanggal_selesai && $ag->tanggal_selesai->ne($ag->tanggal_mulai))
                                                &mdash; {{ \Illuminate\Support\Carbon::parse($ag->tanggal_selesai)->locale('id')->isoFormat('D MMM YYYY') }}
                                            @endif
                                        </span>
                                    </div>
                                    @if($ag->lokasi_text)
                                        <div class="agenda-meta-row">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                            <span class="truncate-line">{{ $ag->lokasi_text }}</span>
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-link" aria-label="Lihat detail {{ $ag->judul }}">
                                    Detail Kegiatan
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                </a>
                            </div>
                        </article>
                    @else
                        <article class="agenda-row" aria-label="{{ $ag->judul }}">
                            <time class="agenda-row-date" datetime="{{ $ag->tanggal_mulai->toDateString() }}">
                                <span class="agenda-row-day">{{ $startDate->format('d') }}</span>
                                <span class="agenda-row-month">{{ $startDate->isoFormat('MMM YYYY') }}</span>
                            </time>

                            <div class="agenda-row-main">
                                <div class="agenda-row-head">
                                    <x-partials.status-badge :status="$status" />
                                </div>
                                <h3 class="agenda-row-title">
                                    <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-row-title-link">
                                        {{ $ag->judul }}
                                    </a>
                                </h3>
                                @if($ag->lokasi_text)
                                    <p class="agenda-row-loc">{{ $ag->lokasi_text }}</p>
                                @endif
                            </div>

                            <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-row-arrow" aria-label="Lihat detail {{ $ag->judul }}">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                            </a>
                        </article>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 + UX-SCR-008 | SECTION: Peta Desa + Kontak Desa
     ============================================================ --}}
<section class="peta-kontak-section" aria-label="Peta dan Kontak Desa">
    <div class="container">
        <div class="peta-kontak-layout">

            {{-- Kolom Kiri: Peta Desa --}}
            <div class="peta-col" id="peta-desa">
                <div class="section-badge" aria-hidden="true">Peta Interaktif</div>
                <h2 class="section-title" id="peta-heading">Peta Wilayah Desa</h2>
                <p class="section-desc peta-desc">Jelajahi sebaran lokasi fasilitas umum, sentra UMKM, dan titik pelayanan di seluruh dusun.</p>

                <div class="atlas">
                    {{-- Filter bar --}}
                    <div class="map-toolbar">
                        <div class="map-filter-group">
                            <label for="map-desa-filter-dusun" class="map-filter-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/></svg>
                                <span>Filter Dusun</span>
                            </label>
                            <select id="map-desa-filter-dusun" class="map-filter-select" aria-label="Filter berdasarkan Dusun">
                                <option value="semua">Semua Wilayah Dusun</option>
                                @foreach($dusunFilterOptions as $opt)
                                    <option value="{{ $opt['id'] }}">{{ $opt['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="map-filter-group">
                            <label for="map-desa-filter-cat" class="map-filter-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 9h16M4 15h16M10 3L8 21M16 3l-2 18"/></svg>
                                <span>Filter Kategori</span>
                            </label>
                            <select id="map-desa-filter-cat" class="map-filter-select" aria-label="Filter berdasarkan Kategori">
                                <option value="semua">Semua Kategori Titik</option>
                                @foreach($categoryOptions as $cat)
                                    <option value="{{ e($cat) }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Leaflet Map container --}}
                    <div class="map-frame">
                        <div
                            id="map-desa"
                            data-map
                            style="height:100%;width:100%;"
                            aria-label="Peta Desa dengan marker lokasi"
                            role="img"
                        ></div>
                    </div>

                    <div class="atlas-caption">
                        <span class="atlas-caption-text">Peta Desa &mdash; {{ $desa?->nama_desa ?? 'Desa Bendung' }}</span>
                        <span class="atlas-legend" aria-hidden="true">
                            <span class="atlas-legend-item"><span class="atlas-dot atlas-dot-umkm"></span>UMKM</span>
                            <span class="atlas-legend-item"><span class="atlas-dot atlas-dot-pelayanan"></span>Pelayanan</span>
                            <span class="atlas-legend-item"><span class="atlas-dot atlas-dot-fasilitas"></span>Fasilitas</span>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Kontak Desa (Forest Panel) --}}
            <div class="kontak-panel" id="kontak-desa" aria-labelledby="kontak-heading">
                <div class="kontak-panel-head">
                    <span class="section-badge kontak-badge" aria-hidden="true">Hubungi Kami</span>
                    <h2 class="kontak-heading" id="kontak-heading">Kontak Pelayanan</h2>
                    <p class="kontak-desc">Saluran resmi komunikasi dan pengaduan masyarakat desa.</p>
                </div>

                @if($desa)
                    <ul class="kontak-list">
                        @if($desa->nomor_kontak)
                            <li class="kontak-item">
                                <span class="kontak-item-icon" aria-hidden="true">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <div class="kontak-item-body">
                                    <span class="kontak-item-label">WhatsApp &amp; Telepon</span>
                                    <strong class="kontak-item-value">{{ $desa->nomor_kontak }}</strong>
                                </div>
                            </li>
                        @endif

                        @if($desa->alamat_kantor)
                            <li class="kontak-item">
                                <span class="kontak-item-icon" aria-hidden="true">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <div class="kontak-item-body">
                                    <span class="kontak-item-label">Alamat Kantor Balai Desa</span>
                                    <strong class="kontak-item-value">{{ $desa->alamat_kantor }}</strong>
                                </div>
                            </li>
                        @endif

                        @if($desa->jam_pelayanan)
                            <li class="kontak-item">
                                <span class="kontak-item-icon" aria-hidden="true">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <div class="kontak-item-body">
                                    <span class="kontak-item-label">Jam Pelayanan Kantor</span>
                                    <strong class="kontak-item-value">{{ $desa->jam_pelayanan }}</strong>
                                </div>
                            </li>
                        @endif

                        @if($desa->email)
                            <li class="kontak-item">
                                <span class="kontak-item-icon" aria-hidden="true">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <div class="kontak-item-body">
                                    <span class="kontak-item-label">Email Resmi Desa</span>
                                    <strong class="kontak-item-value">{{ $desa->email }}</strong>
                                </div>
                            </li>
                        @endif
                    </ul>

                    @if($desa->nomor_kontak)
                        <div class="kontak-wa-wrap">
                            <x-partials.whatsapp-btn :nomor="$desa->nomor_kontak" label="Hubungi via WhatsApp" />
                        </div>
                    @endif
                @else
                    <x-partials.empty-state label="Informasi kontak Desa belum tersedia." />
                @endif
            </div>

        </div>
    </div>
</section>

</div>
@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};

    document.addEventListener('DOMContentLoaded', function () {
        var mapEl = document.getElementById('map-desa');
        if (mapEl) {
            mapEl.setAttribute('id', 'map-desa');
        }

        const filterDusunEl = document.getElementById('map-desa-filter-dusun');
        const filterCatEl   = document.getElementById('map-desa-filter-cat');
        if (filterDusunEl) filterDusunEl.id = 'map-desa-filter-dusun';
        if (filterCatEl)   filterCatEl.id   = 'map-desa-filter-cat';

        if (typeof window.initMap === 'function') {
            window.initMap('map-desa');
        }
    });
</script>
@endpush
