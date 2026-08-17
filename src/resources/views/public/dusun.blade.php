@extends('layouts.public')

@section('title', $dusun->nama_dusun . ' — Portal Informasi ' . 'Desa Bendung')
@push('meta')
    <meta name="description" content="Halaman informasi publik {{ $dusun->nama_dusun }}: profil, kepala dusun, kontak pelayanan, UMKM, fasilitas, agenda, dan pengumuman.">
@endpush

@section('content')
<div class="page-dusun">

{{-- ============================================================
     UX-SCR-002 | HERO / IDENTITAS DUSUN (Compact Gazette Masthead)
     ============================================================ --}}
<header class="dusun-hero" id="header-dusun" aria-labelledby="dusun-page-title">
    <div class="container">
        <div class="dusun-hero-lockup" data-reveal>
            <a href="{{ route('home') }}#dusun" class="dusun-hero-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Semua Dusun</span>
            </a>
            <p class="dusun-hero-eyebrow">
                <span class="dusun-hero-eyebrow-rule" aria-hidden="true"></span>
                <span>Portal Informasi Dusun</span>
            </p>
            <h1 class="dusun-hero-title" id="dusun-page-title">{{ $dusun->nama_dusun }}</h1>
            @if($dusun->deskripsi_singkat)
                <p class="dusun-hero-desc">{{ Str::limit($dusun->deskripsi_singkat, 180) }}</p>
            @endif
        </div>
    </div>
</header>

{{-- ============================================================
     UX-SCR-002 | QUICK NAVIGATION (Non-sticky Gazette Index)
     ============================================================ --}}
<nav class="quick-nav" aria-label="Navigasi cepat halaman {{ $dusun->nama_dusun }}">
    <div class="container">
        <ul class="quick-nav-list" role="list">
            <li><a href="#profil-dusun"      class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">01</span>Profil Dusun</a></li>
            <li><a href="#peta-dusun"        class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">02</span>Peta Dusun</a></li>
            <li><a href="#kontak-pelayanan"  class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">03</span>Kontak Pelayanan</a></li>
            <li><a href="#umkm"              class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">04</span>UMKM</a></li>
            <li><a href="#fasilitas"         class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">05</span>Fasilitas</a></li>
            <li><a href="#agenda"            class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">06</span>Agenda &amp; Kegiatan</a></li>
            <li><a href="#pengumuman"        class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">07</span>Pengumuman</a></li>
        </ul>
    </div>
</nav>

{{-- ============================================================
     UX-SCR-002 | TENTANG DUSUN (Profil + Fakta + Kepala Dusun)
     ============================================================ --}}
<section class="section-tentang" id="profil-dusun" aria-labelledby="profil-heading">
    <div class="container">
        <div class="tentang-spread">

            {{-- Kolom Kiri: Narasi + Fakta + Kepala Dusun --}}
            <div class="tentang-main" data-reveal>
                <div class="section-badge" aria-hidden="true">Tentang Dusun</div>
                <h2 class="section-title" id="profil-heading">Profil Dusun</h2>

                @if($dusun->deskripsi_singkat)
                    <div class="tentang-narasi">
                        <p>{{ $dusun->deskripsi_singkat }}</p>
                    </div>
                @else
                    <x-partials.empty-state label="Profil Dusun belum tersedia." />
                @endif

                {{-- Fakta ringkas dusun --}}
                <dl class="tentang-facts">
                    <div class="tentang-fact">
                        <dt>Rukun Tetangga</dt>
                        <dd>{{ $dusun->jumlah_rt }} RT</dd>
                    </div>
                    <div class="tentang-fact">
                        <dt>Rukun Warga</dt>
                        <dd>{{ $dusun->jumlah_rw }} RW</dd>
                    </div>
                    <div class="tentang-fact">
                        <dt>Fasilitas Umum</dt>
                        <dd>{{ $fasilitas->count() }} Titik</dd>
                    </div>
                    <div class="tentang-fact">
                        <dt>UMKM</dt>
                        <dd>{{ $umkms->count() }} Usaha</dd>
                    </div>
                </dl>

                {{-- Kepala Dusun sebagai sign-off dokumen --}}
                <div class="tentang-kades" id="kepala-dusun">
                    <span class="tentang-kades-label">Kepala Dusun</span>
                    <strong class="tentang-kades-name">{{ $dusun->nama_kepala_dusun }}</strong>
                </div>
            </div>

            {{-- Kolom Kanan: Foto Dusun (framed plate) --}}
            <figure class="tentang-media" data-reveal>
                <x-partials.media-placeholder
                    :src="$dusun->banner_path"
                    :alt="'Foto ' . $dusun->nama_dusun"
                    class="tentang-img"
                />
                <figcaption class="tentang-media-caption">
                    <span class="tentang-media-caption-rule" aria-hidden="true"></span>
                    Dokumentasi wilayah {{ $dusun->nama_dusun }}
                </figcaption>
            </figure>

        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-009 | PETA DUSUN (Atlas Frame — orientasi wilayah)
     ============================================================ --}}
<section class="section-peta" id="peta-dusun" aria-labelledby="peta-dusun-heading">
    <div class="container">
        <div class="peta-head" data-reveal>
            <div class="section-badge" aria-hidden="true">Peta Interaktif</div>
            <h2 class="section-title" id="peta-dusun-heading">Peta Dusun</h2>
            <p class="section-desc">Sebaran lokasi fasilitas, UMKM, dan titik pelayanan di wilayah {{ $dusun->nama_dusun }}.</p>
        </div>

        <div class="atlas" data-reveal>
            {{-- Category filter (no dusun selector — dusun is implicit) --}}
            <div class="map-toolbar">
                <div class="map-filter-group">
                    <label for="map-dusun-filter-cat" class="map-filter-label">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 9h16M4 15h16M10 3L8 21M16 3l-2 18"/></svg>
                        <span>Filter Kategori</span>
                    </label>
                    <select id="map-dusun-filter-cat" class="map-filter-select" aria-label="Filter berdasarkan kategori">
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

            <div class="atlas-caption">
                <span class="atlas-caption-text">Peta Dusun &mdash; {{ $dusun->nama_dusun }}</span>
                <span class="atlas-legend" aria-hidden="true">
                    <span class="atlas-legend-item"><span class="atlas-dot atlas-dot-umkm"></span>UMKM</span>
                    <span class="atlas-legend-item"><span class="atlas-dot atlas-dot-pelayanan"></span>Pelayanan</span>
                    <span class="atlas-legend-item"><span class="atlas-dot atlas-dot-fasilitas"></span>Fasilitas</span>
                </span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | KONTAK PELAYANAN (Forest Band — swipeable people)
     ============================================================ --}}
<section class="section-kontak" id="kontak-pelayanan" aria-labelledby="kontak-pel-heading">
    <div class="container">
        <div class="section-headbar" data-reveal>
            <div>
                <div class="section-badge section-badge-dark" aria-hidden="true">Perangkat Dusun</div>
                <h2 class="section-title kontak-title" id="kontak-pel-heading">Kontak Pelayanan</h2>
            </div>
            @if($kontaks->isNotEmpty())
                <p class="kontak-note">{{ $kontaks->count() }} petugas pelayanan tersedia untuk membantu warga.</p>
            @endif
        </div>

        @if($kontaks->isEmpty())
            <x-partials.empty-state label="Belum ada kontak pelayanan yang terdaftar." />
        @else
            <div class="kontak-strip snap-strip" data-reveal role="region" tabindex="0" aria-label="Daftar petugas pelayanan, geser untuk melihat">
                @foreach($kontaks as $k)
                    <div class="kontak-card" id="kontak-{{ $k->id }}">
                        <div class="kontak-card-top">
                            @if($k->foto_path)
                                <img
                                    src="{{ asset('storage/' . $k->foto_path) }}"
                                    alt="Foto {{ $k->nama }}"
                                    class="kontak-card-photo"
                                    loading="lazy"
                                    width="52" height="52"
                                >
                            @else
                                <div class="kontak-card-photo kontak-card-photo-fallback" aria-hidden="true">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
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
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | UMKM (Visual Showcase — ekonomi warga)
     ============================================================ --}}
<section class="section-umkm" id="umkm" aria-labelledby="umkm-heading">
    <div class="container">
        <div class="section-headbar" data-reveal>
            <div>
                <div class="section-badge" aria-hidden="true">Ekonomi Lokal</div>
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
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | FASILITAS (Compact Resource Cards)
     ============================================================ --}}
<section class="section-fasilitas" id="fasilitas" aria-labelledby="fasilitas-heading">
    <div class="container">
        <div class="section-headbar" data-reveal>
            <div>
                <div class="section-badge" aria-hidden="true">Infrastruktur</div>
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
                        <div class="facility-card-head">
                            @if($f->kategoriFasilitas?->nama_kategori)
                                <span class="facility-cat">{{ $f->kategoriFasilitas->nama_kategori }}</span>
                            @endif
                            <h3 class="facility-card-name">{{ $f->nama }}</h3>
                            @if($f->alamat)
                                <p class="facility-card-addr">{{ $f->alamat }}</p>
                            @endif
                        </div>
                        <a href="{{ route('fasilitas.show', $f->id) }}" class="facility-card-link" aria-label="Lihat lokasi {{ $f->nama }}">
                            Lihat Lokasi
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | INFORMASI TERKINI (Agenda + Pengumuman)
     ============================================================ --}}
<section class="section-terkini" aria-labelledby="terkini-heading">
    <div class="container">
        <div class="terkini-head" data-reveal>
            <div class="section-badge" aria-hidden="true">Warta Wilayah</div>
            <h2 class="section-title" id="terkini-heading">Informasi Terkini</h2>
        </div>

        <div class="terkini-grid">

            {{-- Kolom Agenda & Kegiatan --}}
            <div class="terkini-col" id="agenda" aria-labelledby="agenda-dusun-heading">
                <div class="terkini-col-head">
                    <h3 class="terkini-col-title" id="agenda-dusun-heading">Agenda &amp; Kegiatan</h3>
                </div>

                @if($agendas->isEmpty())
                    <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
                @else
                    <ul class="terkini-ledger" data-reveal>
                        @foreach($agendas as $ag)
                            @php
                                $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                                $status = $ag->effectiveStatusFor($now);
                                $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                            @endphp
                            <li class="terkini-row" id="agenda-{{ $ag->id }}">
                                <time class="terkini-date" datetime="{{ $startDate->toDateString() }}">
                                    <span class="terkini-date-day">{{ $startDate->format('d') }}</span>
                                    <span class="terkini-date-month">{{ $startDate->isoFormat('MMM') }}</span>
                                    <span class="terkini-date-year">{{ $startDate->format('Y') }}</span>
                                </time>

                                <div class="terkini-main">
                                    <div class="terkini-meta">
                                        <x-partials.status-badge :status="$status" />
                                        @if($ag->lokasi_text)
                                            <span class="terkini-loc">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                                {{ $ag->lokasi_text }}
                                            </span>
                                        @endif
                                    </div>
                                    <h4 class="terkini-title">
                                        <a href="{{ route('agenda.show', $ag->id) }}" class="terkini-title-link">
                                            {{ $ag->judul }}
                                        </a>
                                    </h4>
                                </div>

                                <a href="{{ route('agenda.show', $ag->id) }}" class="terkini-arrow" aria-label="Detail agenda: {{ $ag->judul }}">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Kolom Pengumuman --}}
            <div class="terkini-col" id="pengumuman" aria-labelledby="pengumuman-dusun-heading">
                <div class="terkini-col-head">
                    <h3 class="terkini-col-title" id="pengumuman-dusun-heading">Pengumuman</h3>
                    <a href="{{ route('pengumuman.arsip', ['dusun' => $dusun->id]) }}" class="arsip-link" aria-label="Lihat arsip pengumuman {{ $dusun->nama_dusun }}">
                        <span>Lihat Arsip</span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

                @if($pengumumans->isEmpty())
                    <x-partials.empty-state label="Belum ada pengumuman aktif." />
                @else
                    <ul class="terkini-ledger" data-reveal>
                        @foreach($pengumumans as $p)
                            @php $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); @endphp
                            <li class="terkini-row" id="pengumuman-{{ $p->id }}">
                                <time class="terkini-date" datetime="{{ $p->created_at->toDateString() }}">
                                    <span class="terkini-date-day">{{ $pDate->format('d') }}</span>
                                    <span class="terkini-date-month">{{ $pDate->isoFormat('MMM') }}</span>
                                    <span class="terkini-date-year">{{ $pDate->format('Y') }}</span>
                                </time>

                                <div class="terkini-main">
                                    <div class="terkini-meta">
                                        <span class="terkini-chip">Warta Resmi</span>
                                        <span class="terkini-expiry">Berlaku s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                    </div>
                                    <h4 class="terkini-title">
                                        <a href="{{ route('pengumuman.show', $p->id) }}" class="terkini-title-link">
                                            {{ $p->judul }}
                                        </a>
                                    </h4>
                                </div>

                                <a href="{{ route('pengumuman.show', $p->id) }}" class="terkini-arrow" aria-label="Baca pengumuman: {{ $p->judul }}">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                                </a>
                            </li>
                        @endforeach
                    </ul>
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
        if (typeof window.initMap === 'function') {
            window.initMap('map-dusun');
        }
    });
</script>
@endpush
