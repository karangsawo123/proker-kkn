@extends('layouts.public')

@section('title', ($desa?->nama_desa ?? 'Desa Bendung') . ' — Portal Informasi')
@push('meta')
    <meta name="description" content="Portal informasi publik {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Temukan profil desa, dusun aktif, UMKM, fasilitas, agenda kegiatan, pengumuman, dan peta lokasi.">
@endpush

@section('content')

{{-- ============================================================
     UX-SCR-001 | SECTION 1: Hero / Identitas Desa (Cinematic & Editorial)
     ============================================================ --}}
<section
    class="hero{{ !($desa?->banner_path) ? ' hero-fallback' : '' }}"
    id="beranda"
    aria-labelledby="hero-heading"
    @if($desa?->banner_path)
        style="background-image: url('{{ asset('storage/' . $desa->banner_path) }}');"
    @endif
>
    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="hero-body">
        <div class="container">
            <div class="hero-content-wrap">
                <h1 class="hero-title" id="hero-heading">
                    {{ $desa?->nama_desa ?? 'Desa Bendung' }}
                </h1>

                <div class="hero-accent-line" aria-hidden="true"></div>

                <p class="hero-desc">
                    {{ $desa?->deskripsi_singkat ?? 'Pusat informasi terpadu profil desa, potensi dusun, pelayanan masyarakat, fasilitas, dan kegiatan warga dalam satu portal resmi.' }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     Akses Cepat (Quick Navigation Bar)
     ============================================================ --}}
<section class="hero-quickbar" aria-label="Akses Cepat Menu Desa">
    <div class="container">
        <div class="hero-quickbar-inner">
            <span class="hero-quickbar-label">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                <span>Akses Cepat:</span>
            </span>
            <div class="hero-quickbar-links">
                <a href="#dusun" class="quickbar-link">
                    <span>Pilihan Dusun</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                </a>
                <a href="#informasi-desa" class="quickbar-link">
                    <span>Profil Desa</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                </a>
                <a href="#pengumuman" class="quickbar-link">
                    <span>Pengumuman</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                </a>
                <a href="#agenda" class="quickbar-link">
                    <span>Agenda Kegiatan</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                </a>
                <a href="#peta-desa" class="quickbar-link">
                    <span>Peta Wilayah</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                </a>
                <a href="#kontak-desa" class="quickbar-link">
                    <span>Kontak Pelayanan</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 2: Pilihan Dusun Aktif
     ============================================================ --}}
<section class="section-public section-dusun" id="dusun" aria-labelledby="dusun-heading">
    <div class="container">
        <div class="section-intro">
            <div class="section-badge" aria-hidden="true">WILAYAH ADMINISTRATIF</div>
            <h2 class="section-title" id="dusun-heading">Pilihan Dusun</h2>
            <p class="section-desc">Eksplorasi potensi dan profil dari 6 dusun aktif di wilayah {{ $desa?->nama_desa ?? 'Desa Bendung' }}.</p>
        </div>

        @if($dusuns->isEmpty())
            <x-partials.empty-state label="Belum ada Dusun aktif yang terdaftar." />
        @else
            <div class="dusun-compact-grid">
                @foreach($dusuns as $index => $dusun)
                    <a href="{{ route('dusun.show', $dusun->id) }}" class="dusun-ccard" id="dusun-card-{{ $dusun->id }}">
                        <span class="dusun-ccard-tag">Dusun 0{{ $index + 1 }}</span>
                        <div class="dusun-ccard-icon" aria-hidden="true">
                            @php $iconIdx = $index % 6; @endphp
                            @if($iconIdx === 0)
                                {{-- Dusun 1: Balai / Sentra --}}
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            @elseif($iconIdx === 1)
                                {{-- Dusun 2: Pertanian / Tani --}}
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22c1-1 2-2 4-2s3 2 4 2 2-2 4-2 3 2 4 2"/><path d="M2 17c1-1 2-2 4-2s3 2 4 2 2-2 4-2 3 2 4 2"/><path d="M12 2v12"/><path d="M8 6l4-4 4 4"/></svg>
                            @elseif($iconIdx === 2)
                                {{-- Dusun 3: Perbukitan & Alam --}}
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22V12"/><path d="M5 12H2l10-10 10 10h-3"/><path d="M5 17H2l10-10 10 10h-3"/></svg>
                            @elseif($iconIdx === 3)
                                {{-- Dusun 4: UMKM & Kuliner --}}
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 20 9 4 15 14 18 10 21 20 3 20"/></svg>
                            @elseif($iconIdx === 4)
                                {{-- Dusun 5: Mata Air & Perikanan --}}
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12c1.5-2 3-3 4-3s2.5 1 4 1 2.5-1 4-1 2.5 1 4 3"/><path d="M2 17c1.5-2 3-3 4-3s2.5 1 4 1 2.5-1 4-1 2.5 1 4 3"/><path d="M2 7c1.5-2 3-3 4-3s2.5 1 4 1 2.5-1 4-1 2.5 1 4 3"/></svg>
                            @else
                                {{-- Dusun 6: Perkebunan & Kerajinan --}}
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                            @endif
                        </div>
                        <div class="dusun-ccard-text">
                            <span class="dusun-ccard-name">{{ $dusun->nama_dusun }}</span>
                            <span class="dusun-ccard-sub">Buka Profil &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 3: Informasi Desa (Asymmetric Editorial Layout)
     ============================================================ --}}
<section class="section-alt section-info-desa" id="informasi-desa" aria-labelledby="info-desa-heading">
    <div class="container">
        <div class="section-intro">
            <div class="section-badge" aria-hidden="true">IDENTITAS & LAYANAN</div>
            <h2 class="section-title" id="info-desa-heading">Informasi Desa</h2>
            <p class="section-desc">Sekilas gambaran umum, tata pamong, dan jadwal pelayanan publik pemerintah desa.</p>
        </div>

        <div class="info-editorial-layout">

            {{-- Kolom Kiri: Tentang Desa (Feature Story Card) --}}
            <div class="info-feature-card">
                <div class="info-feature-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>Profil Wilayah</span>
                </div>

                <h3 class="info-feature-title">Tentang {{ $desa?->nama_desa ?? 'Desa Bendung' }}</h3>

                <div class="info-feature-body">
                    @if($desa?->deskripsi_singkat)
                        <p class="info-feature-text">{{ $desa->deskripsi_singkat }}</p>
                    @else
                        <p class="info-feature-text text-muted">Deskripsi dan profil resmi desa ditampilkan di sini.</p>
                    @endif
                </div>

                @if($desa?->nama_kepala_desa)
                    <div class="info-kades-card">
                        <div class="info-kades-avatar" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="info-kades-meta">
                            <span class="info-kades-label">Kepala Desa</span>
                            <strong class="info-kades-name">{{ $desa->nama_kepala_desa }}</strong>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Kolom Kanan: 2 Kartu Administrasi & Pelayanan --}}
            <div class="info-stack-cards">

                {{-- Sub-card 1: Kantor & Administrasi --}}
                <div class="info-subcard">
                    <div class="info-subcard-header">
                        <div class="info-subcard-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M3 7v14M21 7v14M6 11h2M6 15h2M10 11h2M10 15h2M14 11h2M14 15h2M18 11h2M18 15h2M9 3l3-2 3 2"/></svg>
                        </div>
                        <div>
                            <span class="info-subcard-category">Kantor & Administrasi</span>
                            <h4 class="info-subcard-title">Pusat Pemerintahan</h4>
                        </div>
                    </div>

                    <div class="info-subcard-items">
                        @if($desa?->alamat_kantor)
                            <div class="info-item-row">
                                <div class="info-item-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div class="info-item-content">
                                    <span class="info-item-label">Alamat Kantor</span>
                                    <span class="info-item-value">{{ $desa->alamat_kantor }}</span>
                                </div>
                            </div>
                        @endif

                        @if($desa?->email)
                            <div class="info-item-row">
                                <div class="info-item-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <div class="info-item-content">
                                    <span class="info-item-label">Surat Elektronik (Email)</span>
                                    <span class="info-item-value">{{ $desa->email }}</span>
                                </div>
                            </div>
                        @endif

                        @if(!$desa?->alamat_kantor && !$desa?->email)
                            <p class="text-muted" style="margin:0;font-size:0.875rem;">Informasi kantor desa belum tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- Sub-card 2: Jam Pelayanan & Kontak Cepat --}}
                <div class="info-subcard">
                    <div class="info-subcard-header">
                        <div class="info-subcard-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <span class="info-subcard-category">Pelayanan Publik</span>
                            <h4 class="info-subcard-title">Jadwal & Kontak</h4>
                        </div>
                    </div>

                    <div class="info-subcard-items">
                        @if($desa?->jam_pelayanan)
                            <div class="info-item-row">
                                <div class="info-item-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div class="info-item-content">
                                    <span class="info-item-label">Jam Operasional Layanan</span>
                                    <span class="info-item-value">{{ $desa->jam_pelayanan }}</span>
                                </div>
                            </div>
                        @endif

                        @if($desa?->nomor_kontak)
                            <div class="info-item-row">
                                <div class="info-item-icon" aria-hidden="true">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <div class="info-item-content">
                                    <span class="info-item-label">Nomor Pelayanan / WhatsApp</span>
                                    <span class="info-item-value">{{ $desa->nomor_kontak }}</span>
                                </div>
                            </div>
                        @endif

                        @if(!$desa?->jam_pelayanan && !$desa?->nomor_kontak)
                            <p class="text-muted" style="margin:0;font-size:0.875rem;">Informasi jam pelayanan belum tersedia.</p>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 4: Pengumuman Desa Terbaru (Horizontal Slider)
     ============================================================ --}}
<section class="section-public section-pengumuman" id="pengumuman" aria-labelledby="pengumuman-heading">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-badge" aria-hidden="true">WARTA & PEMBERITAHUAN</div>
                <h2 class="section-title" id="pengumuman-heading">Pengumuman Terbaru</h2>
            </div>
            <div class="section-heading-actions">
                <div class="slider-arrows" aria-label="Kontrol geser pengumuman">
                    <button type="button" class="slider-arrow-btn" id="pengumuman-prev" aria-label="Geser ke kiri">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button type="button" class="slider-arrow-btn" id="pengumuman-next" aria-label="Geser ke kanan">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
                <a href="{{ route('pengumuman.arsip') }}" class="btn-outline-pill" aria-label="Lihat semua arsip pengumuman desa">
                    <span>Lihat Semua Arsip</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        @if($pengumumans->isEmpty())
            <x-partials.empty-state label="Belum ada pengumuman aktif." />
        @else
            <div class="pengumuman-slider-wrapper">
                <div class="pengumuman-slider" id="pengumuman-slider" tabindex="0" aria-label="Daftar Pengumuman Terbaru">
                    @foreach($pengumumans as $p)
                        <article class="pengumuman-card" aria-label="{{ $p->judul }}">
                            <div class="pengumuman-card-top">
                                <span class="pengumuman-chip">Warta Resmi</span>
                                <div class="pengumuman-card-date">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <span>Berlaku s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                </div>
                            </div>

                            <div class="pengumuman-card-body">
                                <h3 class="pengumuman-card-title">
                                    <a href="{{ route('pengumuman.show', $p->id) }}" class="pengumuman-title-link">
                                        {{ $p->judul }}
                                    </a>
                                </h3>
                            </div>

                            <div class="pengumuman-card-footer">
                                <a href="{{ route('pengumuman.show', $p->id) }}" class="pengumuman-card-link" aria-label="Baca pengumuman: {{ $p->judul }}">
                                    <span>Baca Selengkapnya</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 5: Agenda/Kegiatan Desa Terbaru (Event Cards)
     ============================================================ --}}
<section class="section-alt section-agenda" id="agenda" aria-labelledby="agenda-heading">
    <div class="container">
        <div class="section-intro">
            <div class="section-badge" aria-hidden="true">JADWAL & KEGIATAN WARGA</div>
            <h2 class="section-title" id="agenda-heading">Agenda & Kegiatan</h2>
            <p class="section-desc">Ikuti berbagai kegiatan kemasyarakatan, pertemuan dusun, dan agenda pembangunan desa.</p>
        </div>

        @if($agendas->isEmpty())
            <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
        @else
            <div class="agenda-grid">
                @foreach($agendas as $ag)
                    @php
                        $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                        $status = $ag->effectiveStatusFor($now);
                        $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                    @endphp
                    <article class="agenda-card" aria-label="{{ $ag->judul }}">
                        <div class="agenda-card-header">
                            <div class="agenda-date-badge">
                                <span class="agenda-date-day">{{ $startDate->format('d') }}</span>
                                <span class="agenda-date-month">{{ $startDate->isoFormat('MMM YYYY') }}</span>
                            </div>
                            <div class="agenda-status-wrap">
                                <x-partials.status-badge :status="$status" />
                            </div>
                        </div>

                        <div class="agenda-card-body">
                            <h3 class="agenda-card-title">
                                <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-title-link">
                                    {{ $ag->judul }}
                                </a>
                            </h3>

                            <div class="agenda-card-meta">
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
                        </div>

                        <div class="agenda-card-footer">
                            <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-card-detail" aria-label="Lihat detail {{ $ag->judul }}">
                                <span>Detail Kegiatan</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 + UX-SCR-008 | SECTION 6: Peta Desa + Kontak Desa
     Side-by-side desktop, stacked mobile
     ============================================================ --}}
<section class="section-public peta-kontak-section" aria-label="Peta dan Kontak Desa">
    <div class="container">
        <div class="peta-kontak-wrapper">

            {{-- Kolom Kiri: Peta Desa --}}
            <div class="peta-col" id="peta-desa">
                <div class="section-intro text-left" style="margin-bottom: var(--space-3);">
                    <div class="section-badge" aria-hidden="true">PETA INTERAKTIF</div>
                    <h2 class="section-title" id="peta-heading">Peta Wilayah Desa</h2>
                    <p class="section-desc">Jelajahi sebaran lokasi fasilitas umum, sentra UMKM, dan titik pelayanan di seluruh dusun.</p>
                </div>

                {{-- Filter bar --}}
                <div class="map-filters-card">
                    <div class="map-filter-group">
                        <label for="map-desa-filter-dusun" class="map-filter-label">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/></svg>
                            <span>Filter Dusun:</span>
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
                            <span>Filter Kategori:</span>
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
            </div>

            {{-- Kolom Kanan: Kontak Desa --}}
            <div class="kontak-col" id="kontak-desa" aria-labelledby="kontak-heading">
                <div class="kontak-col-header">
                    <span class="section-badge" aria-hidden="true">HUBUNGI KAMI</span>
                    <h2 class="kontak-col-heading" id="kontak-heading">Kontak Pelayanan</h2>
                    <p class="kontak-col-desc">Saluran resmi komunikasi dan pengaduan masyarakat desa.</p>
                </div>

                @if($desa)
                    <div class="kontak-cards-stack">
                        @if($desa->nomor_kontak)
                            <div class="kontak-ccard">
                                <div class="kontak-ccard-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <div class="kontak-ccard-text">
                                    <p class="kontak-ccard-label">WhatsApp & Telepon</p>
                                    <p class="kontak-ccard-value">{{ $desa->nomor_kontak }}</p>
                                </div>
                            </div>
                        @endif

                        @if($desa->alamat_kantor)
                            <div class="kontak-ccard">
                                <div class="kontak-ccard-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <div class="kontak-ccard-text">
                                    <p class="kontak-ccard-label">Alamat Kantor Balai Desa</p>
                                    <p class="kontak-ccard-value">{{ $desa->alamat_kantor }}</p>
                                </div>
                            </div>
                        @endif

                        @if($desa->jam_pelayanan)
                            <div class="kontak-ccard">
                                <div class="kontak-ccard-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div class="kontak-ccard-text">
                                    <p class="kontak-ccard-label">Jam Pelayanan Kantor</p>
                                    <p class="kontak-ccard-value">{{ $desa->jam_pelayanan }}</p>
                                </div>
                            </div>
                        @endif

                        @if($desa->email)
                            <div class="kontak-ccard">
                                <div class="kontak-ccard-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <div class="kontak-ccard-text">
                                    <p class="kontak-ccard-label">Email Resmi Desa</p>
                                    <p class="kontak-ccard-value">{{ $desa->email }}</p>
                                </div>
                            </div>
                        @endif

                        @if($desa->nomor_kontak)
                            <div class="kontak-wa-wrap">
                                <x-partials.whatsapp-btn :nomor="$desa->nomor_kontak" label="Hubungi via WhatsApp" />
                            </div>
                        @endif
                    </div>
                @else
                    <x-partials.empty-state label="Informasi kontak Desa belum tersedia." />
                @endif
            </div>

        </div>
    </div>
</section>

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

        var slider = document.getElementById('pengumuman-slider');
        var prevBtn = document.getElementById('pengumuman-prev');
        var nextBtn = document.getElementById('pengumuman-next');
        if (slider && prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function () {
                slider.scrollBy({ left: -360, behavior: 'smooth' });
            });
            nextBtn.addEventListener('click', function () {
                slider.scrollBy({ left: 360, behavior: 'smooth' });
            });
        }
    });
</script>
<script type="module">
    import { initMap } from '/resources/js/map.js';

    const filterDusunEl = document.getElementById('map-desa-filter-dusun');
    const filterCatEl   = document.getElementById('map-desa-filter-cat');
    if (filterDusunEl) filterDusunEl.id = 'map-desa-filter-dusun';
    if (filterCatEl)   filterCatEl.id   = 'map-desa-filter-cat';

    initMap('map-desa');
</script>
@endpush