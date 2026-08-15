@extends('layouts.public')

@section('title', ($desa?->nama_desa ?? 'Desa Bendung') . ' — Portal Informasi')
@push('meta')
    <meta name="description" content="Portal informasi publik {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Temukan profil desa, dusun aktif, UMKM, fasilitas, agenda kegiatan, pengumuman, dan peta lokasi.">
@endpush

@section('content')

{{-- ============================================================
     UX-SCR-001 | SECTION 1: Hero / Identitas Desa
     ============================================================ --}}
<section class="hero" id="beranda" aria-labelledby="hero-heading">
    <div class="container">
        <div class="hero-inner">

            <div class="hero-content">
                <p class="hero-eyebrow">Portal Informasi</p>
                <h1 class="hero-title" id="hero-heading">
                    {{ $desa?->nama_desa ?? 'Desa Bendung' }}
                </h1>
                <p class="hero-desc">
                    {{ $desa?->deskripsi_singkat ?? 'Akses informasi desa dan dusun dalam satu portal yang jelas dan mudah digunakan.' }}
                </p>
            </div>

            <div class="hero-image-wrap">
                @if($desa?->banner_path)
                    <img
                        src="{{ asset('storage/' . $desa->banner_path) }}"
                        alt="Foto {{ $desa->nama_desa }}"
                        class="hero-image"
                        width="640"
                        height="400"
                    >
                @else
                    <div class="hero-image-placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="rgba(250,247,242,0.4)" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 2: Pilihan Dusun Aktif
     ============================================================ --}}
<section class="section-public" id="dusun" aria-labelledby="dusun-heading">
    <div class="container">
        <h2 class="section-title" id="dusun-heading" style="margin-bottom:var(--space-3);">Pilihan Dusun</h2>

        @if($dusuns->isEmpty())
            <x-partials.empty-state label="Belum ada Dusun aktif yang terdaftar." />
        @else
            <div class="card-grid">
                @foreach($dusuns as $dusun)
                    <a href="{{ route('dusun.show', $dusun->id) }}" class="dusun-card" id="dusun-card-{{ $dusun->id }}">
                        <div class="dusun-card-icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <span class="dusun-card-name">{{ $dusun->nama_dusun }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 3: Informasi Desa
     ============================================================ --}}
<section class="section-alt" id="informasi-desa" aria-labelledby="info-desa-heading">
    <div class="container">
        <h2 class="section-title" id="info-desa-heading" style="margin-bottom:var(--space-3);">Informasi Desa</h2>

        <div class="info-block">
            @if($desa?->nama_kepala_desa)
                <div class="info-row">
                    <span class="info-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <div>
                        <p class="info-label">Kepala Desa</p>
                        <p class="info-value">{{ $desa->nama_kepala_desa }}</p>
                    </div>
                </div>
            @endif

            @if($desa?->alamat_kantor)
                <div class="info-row">
                    <span class="info-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div>
                        <p class="info-label">Alamat Kantor</p>
                        <p class="info-value">{{ $desa->alamat_kantor }}</p>
                    </div>
                </div>
            @endif

            @if($desa?->nomor_kontak)
                <div class="info-row">
                    <span class="info-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    <div>
                        <p class="info-label">Nomor Kontak</p>
                        <p class="info-value">{{ $desa->nomor_kontak }}</p>
                    </div>
                </div>
            @endif

            @if($desa?->jam_pelayanan)
                <div class="info-row">
                    <span class="info-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </span>
                    <div>
                        <p class="info-label">Jam Pelayanan</p>
                        <p class="info-value">{{ $desa->jam_pelayanan }}</p>
                    </div>
                </div>
            @endif

            @if($desa?->email)
                <div class="info-row">
                    <span class="info-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </span>
                    <div>
                        <p class="info-label">Email</p>
                        <p class="info-value">{{ $desa->email }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 4: Pengumuman Desa Terbaru (3 items)
     ============================================================ --}}
<section class="section-public" id="pengumuman" aria-labelledby="pengumuman-heading">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-title" id="pengumuman-heading">Pengumuman Terbaru</h2>
            <a href="{{ route('pengumuman.arsip') }}" class="btn-link" aria-label="Lihat semua arsip pengumuman desa">
                Lihat Arsip →
            </a>
        </div>

        @if($pengumumans->isEmpty())
            <x-partials.empty-state label="Belum ada pengumuman aktif." />
        @else
            <div class="resource-list">
                @foreach($pengumumans as $p)
                    <article class="resource-row" aria-label="{{ $p->judul }}">
                        <div class="resource-row-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
                        </div>
                        <div class="resource-row-body">
                            <h3 class="resource-row-title">{{ $p->judul }}</h3>
                            <p class="resource-row-meta">
                                Berlaku hingga {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </p>
                        </div>
                        <div class="resource-row-actions">
                            <a href="{{ route('pengumuman.show', $p->id) }}" class="btn-secondary" style="font-size:0.8125rem;padding:6px 12px;">
                                Baca
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 5: Agenda/Kegiatan Desa Terbaru (3 items)
     ============================================================ --}}
<section class="section-alt" id="agenda" aria-labelledby="agenda-heading">
    <div class="container">
        <h2 class="section-title" id="agenda-heading" style="margin-bottom:var(--space-3);">Agenda / Kegiatan Terbaru</h2>

        @if($agendas->isEmpty())
            <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
        @else
            <div class="resource-list">
                @foreach($agendas as $ag)
                    @php
                        $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                        $status = $ag->effectiveStatusFor($now);
                    @endphp
                    <article class="resource-row" aria-label="{{ $ag->judul }}">
                        <div class="resource-row-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div class="resource-row-body">
                            <h3 class="resource-row-title">{{ $ag->judul }}</h3>
                            <p class="resource-row-meta">
                                {{ \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY') }}
                                @if($ag->tanggal_selesai && $ag->tanggal_selesai->ne($ag->tanggal_mulai))
                                    — {{ \Illuminate\Support\Carbon::parse($ag->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY') }}
                                @endif
                                @if($ag->lokasi_text)
                                    · {{ $ag->lokasi_text }}
                                @endif
                            </p>
                        </div>
                        <div class="resource-row-actions" style="flex-direction:column;align-items:flex-end;gap:var(--space-1);">
                            <x-partials.status-badge :status="$status" />
                            <a href="{{ route('agenda.show', $ag->id) }}" class="btn-link" aria-label="Lihat detail {{ $ag->judul }}">
                                Detail →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 + UX-SCR-008 | SECTION 6: Peta Desa
     ============================================================ --}}
<section class="section-public" id="peta-desa" aria-labelledby="peta-heading">
    <div class="container">
        <h2 class="section-title" id="peta-heading" style="margin-bottom:var(--space-2);">Peta Desa</h2>
        <p class="section-subtitle" style="margin-bottom:var(--space-3);">Temukan lokasi fasilitas, UMKM, dan titik pelayanan di seluruh Dusun aktif.</p>

        {{-- Map filters (outside map surface, per UX-DEC-004) --}}
        <div class="map-filters">
            <div class="map-filter-group">
                <label for="map-desa-filter-dusun" class="map-filter-label">Dusun</label>
                <select id="map-desa-filter-dusun" class="map-filter-select" aria-label="Filter berdasarkan Dusun">
                    <option value="semua">Semua</option>
                    @foreach($dusunFilterOptions as $opt)
                        <option value="{{ $opt['id'] }}">{{ $opt['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="map-filter-group">
                <label for="map-desa-filter-cat" class="map-filter-label">Kategori</label>
                <select id="map-desa-filter-cat" class="map-filter-select" aria-label="Filter berdasarkan Kategori">
                    <option value="semua">Semua</option>
                    @foreach($categoryOptions as $cat)
                        <option value="{{ e($cat) }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="map-wrap">
            <div
                id="map-desa"
                data-map
                style="height:100%;width:100%;"
                aria-label="Peta Desa dengan marker lokasi"
                role="img"
            ></div>
        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 7: Kontak Desa
     ============================================================ --}}
<section class="section-alt" id="kontak-desa" aria-labelledby="kontak-heading">
    <div class="container">
        <h2 class="section-title" id="kontak-heading" style="margin-bottom:var(--space-3);">Kontak Desa</h2>

        @if($desa)
            <div class="info-block" style="max-width:32rem;">
                @if($desa->nomor_kontak)
                    <div class="info-row">
                        <span class="info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <div>
                            <p class="info-label">Telepon</p>
                            <p class="info-value">{{ $desa->nomor_kontak }}</p>
                        </div>
                    </div>
                @endif
                @if($desa->alamat_kantor)
                    <div class="info-row">
                        <span class="info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <div>
                            <p class="info-label">Alamat Kantor</p>
                            <p class="info-value">{{ $desa->alamat_kantor }}</p>
                        </div>
                    </div>
                @endif
                @if($desa->jam_pelayanan)
                    <div class="info-row">
                        <span class="info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <div>
                            <p class="info-label">Jam Pelayanan</p>
                            <p class="info-value">{{ $desa->jam_pelayanan }}</p>
                        </div>
                    </div>
                @endif
                @if($desa->email)
                    <div class="info-row">
                        <span class="info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <div>
                            <p class="info-label">Email</p>
                            <p class="info-value">{{ $desa->email }}</p>
                        </div>
                    </div>
                @endif

                @if($desa->nomor_kontak)
                    <div style="margin-top:var(--space-2);padding-top:var(--space-2);border-top:1px solid rgba(43,47,35,.1);">
                        <x-partials.whatsapp-btn :nomor="$desa->nomor_kontak" label="Hubungi via WhatsApp" />
                    </div>
                @endif
            </div>
        @else
            <x-partials.empty-state label="Informasi kontak Desa belum tersedia." />
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};

    // Override filter element IDs for Peta Desa
    document.addEventListener('DOMContentLoaded', function () {
        // Re-map filter IDs to match map-desa element
        var mapEl = document.getElementById('map-desa');
        if (mapEl) {
            mapEl.setAttribute('id', 'map-desa');
        }
    });
</script>
<script type="module">
    import { initMap } from '/resources/js/map.js';

    // Override filter IDs before init
    const filterDusunEl = document.getElementById('map-desa-filter-dusun');
    const filterCatEl   = document.getElementById('map-desa-filter-cat');
    if (filterDusunEl) filterDusunEl.id = 'map-desa-filter-dusun';
    if (filterCatEl)   filterCatEl.id   = 'map-desa-filter-cat';

    initMap('map-desa');
</script>
@endpush
