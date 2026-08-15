@extends('layouts.public')

@section('title', $dusun->nama_dusun . ' — Portal Informasi ' . ($desa?->nama_desa ?? 'Desa Bendung'))
@push('meta')
    <meta name="description" content="Halaman informasi publik {{ $dusun->nama_dusun }}: profil, kepala dusun, kontak pelayanan, UMKM, fasilitas, agenda, dan pengumuman.">
@endpush

@section('content')

{{-- ============================================================
     UX-SCR-002 | SECTION 1: Banner + Nama Dusun
     ============================================================ --}}
<div
    class="hero"
    id="header-dusun"
    style="min-height:220px;padding-block:var(--space-4);"
    aria-labelledby="dusun-page-title"
>
    @if($dusun->banner_path)
        <div style="position:absolute;inset:0;z-index:0;">
            <img
                src="{{ asset('storage/' . $dusun->banner_path) }}"
                alt=""
                style="width:100%;height:100%;object-fit:cover;opacity:0.35;"
                aria-hidden="true"
            >
        </div>
    @endif
    <div class="container" style="position:relative;z-index:1;">
        <p class="hero-eyebrow">Portal Informasi</p>
        <h1 class="hero-title" id="dusun-page-title">{{ $dusun->nama_dusun }}</h1>
        @if($dusun->deskripsi_singkat)
            <p class="hero-desc">{{ $dusun->deskripsi_singkat }}</p>
        @endif
    </div>
</div>

{{-- ============================================================
     UX-SCR-002 | SECTION 2: Navigasi Cepat
     ============================================================ --}}
<nav class="quick-nav" aria-label="Navigasi cepat halaman {{ $dusun->nama_dusun }}">
    <div class="container">
        <ul class="quick-nav-list" role="list">
            <li><a href="#profil-dusun"      class="quick-nav-link">Profil Dusun</a></li>
            <li><a href="#kepala-dusun"      class="quick-nav-link">Kepala Dusun</a></li>
            <li><a href="#kontak-pelayanan"  class="quick-nav-link">Kontak Pelayanan</a></li>
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
        <h2 class="section-title" id="profil-heading" style="margin-bottom:var(--space-3);">Profil Dusun</h2>
        <div style="display:grid;gap:var(--space-3);align-items:start;" class="detail-grid">
            <div>
                @if($dusun->deskripsi_singkat)
                    <p style="font-size:1rem;line-height:1.8;color:var(--color-dark-olive);">{{ $dusun->deskripsi_singkat }}</p>
                @else
                    <x-partials.empty-state label="Profil Dusun belum tersedia." />
                @endif
            </div>
            <div>
                <x-partials.media-placeholder :src="$dusun->banner_path" :alt="'Foto ' . $dusun->nama_dusun" />
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 4: Kepala Dusun
     ============================================================ --}}
<section class="section-alt" id="kepala-dusun" aria-labelledby="kepala-heading">
    <div class="container">
        <h2 class="section-title" id="kepala-heading" style="margin-bottom:var(--space-3);">Kepala Dusun</h2>
        <div class="kontak-row" style="max-width:28rem;">
            <div class="kontak-avatar-placeholder" aria-hidden="true">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="kontak-info">
                <p class="kontak-name">{{ $dusun->nama_kepala_dusun }}</p>
                <p class="kontak-jabatan">Kepala Dusun</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 5: Kontak Pelayanan
     ============================================================ --}}
<section class="section-public" id="kontak-pelayanan" aria-labelledby="kontak-heading">
    <div class="container">
        <h2 class="section-title" id="kontak-heading" style="margin-bottom:var(--space-3);">Kontak Pelayanan</h2>

        @if($kontaks->isEmpty())
            <x-partials.empty-state label="Belum ada kontak pelayanan yang terdaftar." />
        @else
            <div class="resource-list">
                @foreach($kontaks as $k)
                    <div class="kontak-row" id="kontak-{{ $k->id }}">
                        @if($k->foto_path)
                            <img src="{{ asset('storage/' . $k->foto_path) }}" alt="" class="kontak-avatar" width="48" height="48" aria-hidden="true">
                        @else
                            <div class="kontak-avatar-placeholder" aria-hidden="true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                        <div class="kontak-info">
                            <p class="kontak-name">{{ $k->nama }}</p>
                            <p class="kontak-jabatan">{{ $k->jabatan }}</p>
                        </div>
                        <div style="margin-left:auto;">
                            <x-partials.whatsapp-btn :nomor="$k->nomor_whatsapp" label="WhatsApp" class="" />
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
        <h2 class="section-title" id="umkm-heading" style="margin-bottom:var(--space-3);">UMKM</h2>

        @if($umkms->isEmpty())
            <x-partials.empty-state label="Belum ada UMKM yang terdaftar." />
        @else
            <div class="card-grid-sm">
                @foreach($umkms as $u)
                    <article class="card" id="umkm-{{ $u->id }}">
                        <x-partials.media-placeholder :src="$u->foto_utama_path" :alt="'Foto ' . $u->nama_umkm" class="card-image" />
                        <div class="card-body">
                            <h3 class="card-title">{{ $u->nama_umkm }}</h3>
                            <p class="card-meta">{{ $u->jenis_usaha }}</p>
                            @if($u->produkUmkms->isNotEmpty())
                                <ul class="produk-tag-list">
                                    @foreach($u->produkUmkms->take(3) as $p)
                                        <li class="produk-tag">{{ $p->nama_produk }}</li>
                                    @endforeach
                                    @if($u->produkUmkms->count() > 3)
                                        <li class="produk-tag" style="opacity:.6;">+{{ $u->produkUmkms->count() - 3 }} lainnya</li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('umkm.show', $u->id) }}" class="btn-secondary" style="font-size:0.8125rem;padding:6px 14px;">
                                Lihat Detail
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
        <h2 class="section-title" id="fasilitas-heading" style="margin-bottom:var(--space-3);">Fasilitas</h2>

        @if($fasilitas->isEmpty())
            <x-partials.empty-state label="Belum ada fasilitas yang terdaftar." />
        @else
            <div class="resource-list">
                @foreach($fasilitas as $f)
                    <article class="resource-row" id="fasilitas-{{ $f->id }}">
                        <div class="resource-row-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div class="resource-row-body">
                            <h3 class="resource-row-title">{{ $f->nama }}</h3>
                            <p class="resource-row-meta">
                                {{ $f->kategoriFasilitas?->nama_kategori ?? '—' }}
                                @if($f->alamat) · {{ $f->alamat }} @endif
                            </p>
                        </div>
                        <div class="resource-row-actions">
                            <a href="{{ route('fasilitas.show', $f->id) }}" class="btn-secondary" style="font-size:0.8125rem;padding:6px 12px;">
                                Lihat Lokasi
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 8: Agenda & Kegiatan (DUSUN scope)
     ============================================================ --}}
<section class="section-alt" id="agenda" aria-labelledby="agenda-heading">
    <div class="container">
        <h2 class="section-title" id="agenda-heading" style="margin-bottom:var(--space-3);">Agenda &amp; Kegiatan</h2>

        @if($agendas->isEmpty())
            <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
        @else
            <div class="resource-list">
                @foreach($agendas as $ag)
                    @php
                        $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                        $status = $ag->effectiveStatusFor($now);
                    @endphp
                    <article class="resource-row" id="agenda-{{ $ag->id }}">
                        <div class="resource-row-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div class="resource-row-body">
                            <h3 class="resource-row-title">{{ $ag->judul }}</h3>
                            <p class="resource-row-meta">
                                {{ \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY') }}
                                @if($ag->lokasi_text) · {{ $ag->lokasi_text }} @endif
                            </p>
                        </div>
                        <div class="resource-row-actions" style="flex-direction:column;align-items:flex-end;">
                            <x-partials.status-badge :status="$status" />
                            <a href="{{ route('agenda.show', $ag->id) }}" class="btn-link mt-1">Detail →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 | SECTION 9: Pengumuman (DUSUN scope, active)
     ============================================================ --}}
<section class="section-public" id="pengumuman" aria-labelledby="pengumuman-dusun-heading">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-title" id="pengumuman-dusun-heading">Pengumuman</h2>
            <a href="{{ route('pengumuman.arsip', ['dusun' => $dusun->id]) }}" class="btn-link">
                Lihat Arsip →
            </a>
        </div>

        @if($pengumumans->isEmpty())
            <x-partials.empty-state label="Belum ada pengumuman aktif." />
        @else
            <div class="resource-list">
                @foreach($pengumumans as $p)
                    <article class="resource-row" id="pengumuman-{{ $p->id }}">
                        <div class="resource-row-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
                        </div>
                        <div class="resource-row-body">
                            <h3 class="resource-row-title">{{ $p->judul }}</h3>
                            <p class="resource-row-meta">Berlaku hingga {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                        </div>
                        <div class="resource-row-actions">
                            <a href="{{ route('pengumuman.show', $p->id) }}" class="btn-secondary" style="font-size:0.8125rem;padding:6px 12px;">Baca</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-002 + UX-SCR-009 | SECTION 10: Peta Dusun
     ============================================================ --}}
<section class="section-alt" id="peta-dusun" aria-labelledby="peta-dusun-heading">
    <div class="container">
        <h2 class="section-title" id="peta-dusun-heading" style="margin-bottom:var(--space-2);">Peta Dusun</h2>

        {{-- Category filter only (no Dusun selector — context implicit) --}}
        <div class="map-filters" style="margin-bottom:var(--space-2);">
            <div class="map-filter-group">
                <label for="map-dusun-filter-cat" class="map-filter-label">Kategori</label>
                <select id="map-dusun-filter-cat" class="map-filter-select" aria-label="Filter berdasarkan kategori">
                    <option value="semua">Semua</option>
                    @foreach($categoryOptions as $cat)
                        <option value="{{ e($cat) }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="map-wrap">
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
</script>
<script type="module">
    import { initMap } from '/resources/js/map.js';
    initMap('map-dusun');
</script>
@endpush
