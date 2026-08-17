@extends('layouts.public')

@section('title', $dusun->nama_dusun . ' — Portal Informasi ' . 'Desa Bendung')
@push('meta')
    <meta name="description" content="Halaman informasi publik {{ $dusun->nama_dusun }}: profil, kepala dusun, kontak pelayanan, UMKM, fasilitas, agenda, dan pengumuman.">
@endpush

@section('content')

{{-- ============================================================
     UX-SCR-002 | SECTION 1: Banner + Nama Dusun
     ============================================================ --}}
<div
    class="dusun-hero{{ !$dusun->banner_path ? ' hero-fallback' : '' }}"
    id="header-dusun"
    aria-labelledby="dusun-page-title"
    @if($dusun->banner_path)
        style="background-image: url('{{ asset('storage/' . $dusun->banner_path) }}');"
    @endif
>
    <div class="hero-overlay" aria-hidden="true"></div>
    <div class="dusun-hero-body">
        <div class="container">
            <div class="dusun-hero-lockup" data-reveal>
                <p class="hero-eyebrow">
                    <span class="hero-eyebrow-rule" aria-hidden="true"></span>
                    Portal Informasi Dusun
                </p>
                <h1 class="hero-title" id="dusun-page-title">{{ $dusun->nama_dusun }}</h1>
                @if($dusun->deskripsi_singkat)
                    <p class="hero-desc">{{ Str::limit($dusun->deskripsi_singkat, 180) }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     UX-SCR-002 | SECTION 2: Navigasi Cepat
     ============================================================ --}}
<nav class="quick-nav" aria-label="Navigasi cepat halaman {{ $dusun->nama_dusun }}">
    <div class="container">
        <ul class="quick-nav-list" role="list">
            <li><a href="#profil-dusun"      class="quick-nav-link">Profil Dusun</a></li>
            <li><a href="#kepala-dusun"       class="quick-nav-link">Kepala Dusun</a></li>
            <li><a href="#kontak-pelayanan"   class="quick-nav-link">Kontak Pelayanan</a></li>
            <li><a href="#umkm"              class="quick-nav-link">UMKM</a></li>
            <li><a href="#fasilitas"         class="quick-nav-link">Fasilitas</a></li>
            <li><a href="#agenda"            class="quick-nav-link">Agenda &amp; Kegiatan</a></li>
            <li><a href="#pengumuman"        class="quick-nav-link">Pengumuman</a></li>
            <li><a href="#peta-dusun"        class="quick-nav-link">Peta Dusun</a></li>
        </ul>
    </div>
</nav>

{{-- ============================================================
     UX-SCR-002 | SECTION 3: Profil Dusun
     ============================================================ --}}
<section class="section-public" id="profil-dusun" aria-labelledby="profil-heading">
    <div class="container">
        <div class="dusun-profile-spread">

            {{-- Kolom Kiri: Narasi --}}
            <div class="dusun-profile-prose" data-reveal>
                <div class="section-badge" aria-hidden="true">Tentang Dusun</div>
                <h2 class="section-title" id="profil-heading">Profil Dusun</h2>

                @if($dusun->deskripsi_singkat)
                    <p class="dusun-profile-body">{{ $dusun->deskripsi_singkat }}</p>
                @else
                    <x-partials.empty-state label="Profil Dusun belum tersedia." />
                @endif

                {{-- Fakta ringkas dusun --}}
                <dl class="dusun-facts">
                    <div class="dusun-fact">
                        <dt>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                            <span>Wilayah</span>
                        </dt>
                        <dd>{{ $dusun->nama_dusun }}</dd>
                    </div>
                    <div class="dusun-fact">
                        <dt>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span>Perangkat Desa</span>
                        </dt>
                        <dd>{{ $kontaks->count() }} Kontak Pelayanan</dd>
                    </div>
                    <div class="dusun-fact">
                        <dt>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            <span>Fasilitas Umum</span>
                        </dt>
                        <dd>{{ $fasilitas->count() }} Fasilitas</dd>
                    </div>
                    <div class="dusun-fact">
                        <dt>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            <span>UMKM</span>
                        </dt>
                        <dd>{{ $umkms->count() }} Usaha Terdaftar</dd>
                    </div>
                </dl>
            </div>

            {{-- Kolom Kanan: Foto Dusun --}}
            <div class="dusun-profile-media" data-reveal>
                <x-partials.media-placeholder
                    :src="$dusun->banner_path"
                    :alt="'Foto ' . $dusun->nama_dusun"
                    class="dusun-profile-img"
                />
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 4: Kepala Dusun
     ============================================================ --}}
<section class="section-alt" id="kepala-dusun" aria-labelledby="kepala-heading">
    <div class="container">
        <div class="section-badge" aria-hidden="true">Pimpinan Wilayah</div>
        <h2 class="section-title" id="kepala-heading">Kepala Dusun</h2>

        <div class="leader-card" data-reveal>
            <div class="leader-avatar" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="leader-body">
                <span class="leader-role">Kepala Dusun</span>
                <strong class="leader-name">{{ $dusun->nama_kepala_dusun }}</strong>
                <p class="leader-desc">Bertanggung jawab atas penyelenggaraan pemerintahan dan pemberdayaan masyarakat di wilayah {{ $dusun->nama_dusun }}.</p>
            </div>
            <div class="leader-badge-wrap" aria-hidden="true">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 5: Kontak Pelayanan
     ============================================================ --}}
<section class="section-public" id="kontak-pelayanan" aria-labelledby="kontak-pel-heading">
    <div class="container">
        <div class="section-headbar">
            <div>
                <div class="section-badge" aria-hidden="true">Perangkat Dusun</div>
                <h2 class="section-title" id="kontak-pel-heading">Kontak Pelayanan</h2>
            </div>
            @if($kontaks->isNotEmpty())
                <p class="section-note">{{ $kontaks->count() }} petugas pelayanan tersedia untuk membantu warga.</p>
            @endif
        </div>

        @if($kontaks->isEmpty())
            <x-partials.empty-state label="Belum ada kontak pelayanan yang terdaftar." />
        @else
            <div class="kontak-card-grid" data-reveal>
                @foreach($kontaks as $k)
                    <div class="kontak-card" id="kontak-{{ $k->id }}">
                        <div class="kontak-card-top">
                            @if($k->foto_path)
                                <img
                                    src="{{ asset('storage/' . $k->foto_path) }}"
                                    alt="Foto {{ $k->nama }}"
                                    class="kontak-card-photo"
                                    loading="lazy"
                                    width="64" height="64"
                                >
                            @else
                                <div class="kontak-card-photo kontak-card-photo-fallback" aria-hidden="true">
                                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
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
     UX-SCR-002 | SECTION 6: UMKM
     ============================================================ --}}
<section class="section-alt" id="umkm" aria-labelledby="umkm-heading">
    <div class="container">
        <div class="section-headbar">
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
            <div class="umkm-grid" data-reveal>
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
                            <a href="{{ route('umkm.show', $u->id) }}" class="agenda-link" aria-label="Lihat detail {{ $u->nama_umkm }}">
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
     UX-SCR-002 | SECTION 7: Fasilitas
     ============================================================ --}}
<section class="section-public" id="fasilitas" aria-labelledby="fasilitas-heading">
    <div class="container">
        <div class="section-headbar">
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
            <div class="facility-list" data-reveal>
                @foreach($fasilitas as $f)
                    <article class="facility-item" id="fasilitas-{{ $f->id }}">
                        <div class="facility-item-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div class="facility-item-body">
                            <h3 class="facility-item-name">{{ $f->nama }}</h3>
                            <p class="facility-item-meta">
                                @if($f->kategoriFasilitas?->nama_kategori)
                                    <span class="facility-cat-tag">{{ $f->kategoriFasilitas->nama_kategori }}</span>
                                @endif
                                @if($f->alamat)
                                    <span class="facility-addr">{{ $f->alamat }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="facility-item-action">
                            <a href="{{ route('fasilitas.show', $f->id) }}" class="facility-link" aria-label="Lihat lokasi {{ $f->nama }}">
                                Lihat Lokasi
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
     UX-SCR-002 | SECTION 8: Agenda & Kegiatan (dusun scope)
     ============================================================ --}}
<section class="section-alt" id="agenda" aria-labelledby="agenda-dusun-heading">
    <div class="container">
        <div class="section-headbar">
            <div>
                <div class="section-badge" aria-hidden="true">Jadwal & Kegiatan</div>
                <h2 class="section-title" id="agenda-dusun-heading">Agenda &amp; Kegiatan</h2>
            </div>
        </div>

        @if($agendas->isEmpty())
            <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
        @else
            <ul class="notice-list" data-reveal>
                @foreach($agendas as $ag)
                    @php
                        $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                        $status = $ag->effectiveStatusFor($now);
                        $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                    @endphp
                    <li class="notice-row" id="agenda-{{ $ag->id }}">
                        <time class="notice-date" datetime="{{ $startDate->toDateString() }}">
                            <span class="notice-date-day">{{ $startDate->format('d') }}</span>
                            <span class="notice-date-month">{{ $startDate->isoFormat('MMM YYYY') }}</span>
                        </time>

                        <div class="notice-main">
                            <div class="notice-meta">
                                <x-partials.status-badge :status="$status" />
                                @if($ag->lokasi_text)
                                    <span class="notice-expiry">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        {{ $ag->lokasi_text }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="notice-title">
                                <a href="{{ route('agenda.show', $ag->id) }}" class="notice-title-link">
                                    {{ $ag->judul }}
                                </a>
                            </h3>
                        </div>

                        <a href="{{ route('agenda.show', $ag->id) }}" class="notice-arrow" aria-label="Detail agenda: {{ $ag->judul }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 9: Pengumuman (dusun scope, active)
     ============================================================ --}}
<section class="section-public" id="pengumuman" aria-labelledby="pengumuman-dusun-heading">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-badge" aria-hidden="true">Warta & Pemberitahuan</div>
                <h2 class="section-title" id="pengumuman-dusun-heading">Pengumuman</h2>
            </div>
            <a href="{{ route('pengumuman.arsip', ['dusun' => $dusun->id]) }}" class="btn-outline-pill" aria-label="Lihat arsip pengumuman {{ $dusun->nama_dusun }}">
                <span>Lihat Arsip</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($pengumumans->isEmpty())
            <x-partials.empty-state label="Belum ada pengumuman aktif." />
        @else
            <ul class="notice-list" data-reveal>
                @foreach($pengumumans as $p)
                    @php $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); @endphp
                    <li class="notice-row" id="pengumuman-{{ $p->id }}">
                        <time class="notice-date" datetime="{{ $p->created_at->toDateString() }}">
                            <span class="notice-date-day">{{ $pDate->format('d') }}</span>
                            <span class="notice-date-month">{{ $pDate->isoFormat('MMM YYYY') }}</span>
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
     UX-SCR-002 + UX-SCR-009 | SECTION 10: Peta Dusun
     ============================================================ --}}
<section class="section-alt peta-dusun-section" id="peta-dusun" aria-labelledby="peta-dusun-heading">
    <div class="container">
        <div class="section-badge" aria-hidden="true">Peta Interaktif</div>
        <h2 class="section-title" id="peta-dusun-heading">Peta Dusun</h2>
        <p class="section-desc">Sebaran lokasi fasilitas, UMKM, dan titik pelayanan di wilayah {{ $dusun->nama_dusun }}.</p>

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
    </div>
</section>

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
