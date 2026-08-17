@extends('layouts.public')

@section('title', ($desa?->nama_desa ?? 'Desa Bendung') . ' — Portal Informasi')
@push('meta')
    <meta name="description" content="Portal informasi publik {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Temukan profil desa, dusun aktif, UMKM, fasilitas, agenda kegiatan, pengumuman, dan peta lokasi.">
@endpush

@section('content')

{{-- ============================================================
     UX-SCR-001 | SECTION 1: Hero / Identitas Desa
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
            <p class="hero-eyebrow">Portal Informasi</p>
            <h1 class="hero-title" id="hero-heading">
                {{ $desa?->nama_desa ?? 'Desa Bendung' }}
            </h1>
            <div class="hero-accent-line" aria-hidden="true"></div>
            <p class="hero-desc">
                {{ $desa?->deskripsi_singkat ?? 'Akses informasi desa dan dusun dalam satu portal yang jelas dan mudah digunakan.' }}
            </p>
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
            <div class="dusun-compact-grid">
                @foreach($dusuns as $index => $dusun)
                    <a href="{{ route('dusun.show', $dusun->id) }}" class="dusun-ccard" id="dusun-card-{{ $dusun->id }}">
                        <span class="dusun-ccard-arrow" aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </span>
                        <div class="dusun-ccard-icon" aria-hidden="true">
                            @php $iconIdx = $index % 6; @endphp
                            @if($iconIdx === 0)
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            @elseif($iconIdx === 1)
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22c1-1 2-2 4-2s3 2 4 2 2-2 4-2 3 2 4 2"/><path d="M2 17c1-1 2-2 4-2s3 2 4 2 2-2 4-2 3 2 4 2"/><path d="M12 2v12"/><path d="M8 6l4-4 4 4"/></svg>
                            @elseif($iconIdx === 2)
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22V12"/><path d="M5 12H2l10-10 10 10h-3"/><path d="M5 17H2l10-10 10 10h-3"/></svg>
                            @elseif($iconIdx === 3)
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 20 9 4 15 14 18 10 21 20 3 20"/></svg>
                            @elseif($iconIdx === 4)
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12c1.5-2 3-3 4-3s2.5 1 4 1 2.5-1 4-1 2.5 1 4 3"/><path d="M2 17c1.5-2 3-3 4-3s2.5 1 4 1 2.5-1 4-1 2.5 1 4 3"/><path d="M2 7c1.5-2 3-3 4-3s2.5 1 4 1 2.5-1 4-1 2.5 1 4 3"/></svg>
                            @else
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
                            @endif
                        </div>
                        <span class="dusun-ccard-name">{{ $dusun->nama_dusun }}</span>
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

        <div class="info-summary-grid">

            {{-- Panel 1: Tentang Desa --}}
            <div class="info-panel-card">
                <div class="info-panel-header">
                    <div class="info-panel-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <p class="info-panel-label">Profil</p>
                        <h3 class="info-panel-title">Tentang Desa</h3>
                    </div>
                </div>
                <div class="info-panel-body">
                    @if($desa?->deskripsi_singkat)
                        <p class="info-panel-val">{{ Str::limit($desa->deskripsi_singkat, 160) }}</p>
                    @else
                        <p class="info-panel-val" style="color:var(--color-sage);">Informasi desa ditampilkan di sini.</p>
                    @endif
                    @if($desa?->nama_kepala_desa)
                        <div class="info-panel-row">
                            <span class="info-panel-key">Kepala Desa</span>
                            <span class="info-panel-val">{{ $desa->nama_kepala_desa }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Panel 2: Profil Singkat --}}
            <div class="info-panel-card">
                <div class="info-panel-header">
                    <div class="info-panel-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <p class="info-panel-label">Administrasi</p>
                        <h3 class="info-panel-title">Profil Singkat</h3>
                    </div>
                </div>
                <div class="info-panel-body">
                    @if($desa?->alamat_kantor)
                        <div class="info-panel-row">
                            <span class="info-panel-key">Alamat Kantor</span>
                            <span class="info-panel-val">{{ $desa->alamat_kantor }}</span>
                        </div>
                    @endif
                    @if($desa?->email)
                        <div class="info-panel-row">
                            <span class="info-panel-key">Email</span>
                            <span class="info-panel-val">{{ $desa->email }}</span>
                        </div>
                    @endif
                    @if(!$desa?->alamat_kantor && !$desa?->email)
                        <p class="info-panel-val" style="color:var(--color-sage);">Informasi desa ditampilkan di sini.</p>
                    @endif
                </div>
            </div>

            {{-- Panel 3: Informasi Pelayanan --}}
            <div class="info-panel-card">
                <div class="info-panel-header">
                    <div class="info-panel-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <p class="info-panel-label">Layanan</p>
                        <h3 class="info-panel-title">Informasi Pelayanan</h3>
                    </div>
                </div>
                <div class="info-panel-body">
                    @if($desa?->jam_pelayanan)
                        <div class="info-panel-row">
                            <span class="info-panel-key">Jam Pelayanan</span>
                            <span class="info-panel-val">{{ $desa->jam_pelayanan }}</span>
                        </div>
                    @endif
                    @if($desa?->nomor_kontak)
                        <div class="info-panel-row">
                            <span class="info-panel-key">Nomor Kontak</span>
                            <span class="info-panel-val">{{ $desa->nomor_kontak }}</span>
                        </div>
                    @endif
                    @if(!$desa?->jam_pelayanan && !$desa?->nomor_kontak)
                        <p class="info-panel-val" style="color:var(--color-sage);">Informasi pelayanan publik ditampilkan di sini.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     UX-SCR-001 | SECTION 4: Pengumuman Desa Terbaru (3 items)
     ============================================================ --}}
<section class="section-public" id="pengumuman" aria-labelledby="pengumuman-heading">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-title" id="pengumuman-heading">Pengumuman</h2>
            <a href="{{ route('pengumuman.arsip') }}" class="btn-link" aria-label="Lihat semua arsip pengumuman desa">
                Lihat Semua &rarr;
            </a>
        </div>

        @if($pengumumans->isEmpty())
            <x-partials.empty-state label="Belum ada pengumuman aktif." />
        @else
            <div class="pengumuman-grid">
                @foreach($pengumumans as $p)
                    <article class="pengumuman-card" aria-label="{{ $p->judul }}">
                        <div class="pengumuman-card-visual">
                            <svg class="pengumuman-card-visual-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                            <span class="pengumuman-card-badge">Terbaru</span>
                        </div>
                        <div class="pengumuman-card-body">
                            <h3 class="pengumuman-card-title">{{ $p->judul }}</h3>
                            <p class="pengumuman-card-meta">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                Berlaku hingga {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}
                            </p>
                            <a href="{{ route('pengumuman.show', $p->id) }}" class="pengumuman-card-link" aria-label="Baca pengumuman: {{ $p->judul }}">
                                Baca selengkapnya &rarr;
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
        <h2 class="section-title" id="agenda-heading" style="margin-bottom:var(--space-3);">Agenda / Kegiatan</h2>

        @if($agendas->isEmpty())
            <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
        @else
            <div class="agenda-grid">
                @foreach($agendas as $ag)
                    @php
                        $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                        $status = $ag->effectiveStatusFor($now);
                    @endphp
                    <article class="agenda-card" aria-label="{{ $ag->judul }}">
                        <div class="agenda-card-visual">
                            <svg class="agenda-card-visual-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <div class="agenda-card-badge">
                                <x-partials.status-badge :status="$status" />
                            </div>
                        </div>
                        <div class="agenda-card-body">
                            <h3 class="agenda-card-title">{{ $ag->judul }}</h3>
                            <div class="agenda-card-meta">
                                <div class="agenda-card-meta-row">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    <span>
                                        {{ \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id')->isoFormat('D MMM YYYY') }}
                                        @if($ag->tanggal_selesai && $ag->tanggal_selesai->ne($ag->tanggal_mulai))
                                            &mdash; {{ \Illuminate\Support\Carbon::parse($ag->tanggal_selesai)->locale('id')->isoFormat('D MMM YYYY') }}
                                        @endif
                                    </span>
                                </div>
                                @if($ag->lokasi_text)
                                    <div class="agenda-card-meta-row">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $ag->lokasi_text }}</span>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('agenda.show', $ag->id) }}" class="agenda-card-detail" aria-label="Lihat detail {{ $ag->judul }}">
                                Detail &rarr;
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
<section class="peta-kontak-section" aria-label="Peta dan Kontak Desa">
    <div class="container">
        <div class="peta-kontak-wrapper">

            {{-- Kolom Kiri: Peta Desa --}}
            <div class="peta-col" id="peta-desa">
                <h2 class="section-title" id="peta-heading">Peta Desa</h2>
                <p class="section-subtitle">Temukan lokasi fasilitas, UMKM, dan titik pelayanan di seluruh Dusun aktif.</p>

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

            {{-- Kolom Kanan: Kontak Desa --}}
            <div class="kontak-col" id="kontak-desa" aria-labelledby="kontak-heading">
                <h2 class="kontak-col-heading" id="kontak-heading">Kontak Desa</h2>

                @if($desa)
                    @if($desa->nomor_kontak)
                        <div class="kontak-ccard">
                            <div class="kontak-ccard-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.5a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.09a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div>
                                <p class="kontak-ccard-label">WhatsApp / Telepon</p>
                                <p class="kontak-ccard-value">{{ $desa->nomor_kontak }}</p>
                            </div>
                        </div>
                    @endif

                    @if($desa->alamat_kantor)
                        <div class="kontak-ccard">
                            <div class="kontak-ccard-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <p class="kontak-ccard-label">Alamat Kantor</p>
                                <p class="kontak-ccard-value">{{ $desa->alamat_kantor }}</p>
                            </div>
                        </div>
                    @endif

                    @if($desa->jam_pelayanan)
                        <div class="kontak-ccard">
                            <div class="kontak-ccard-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div>
                                <p class="kontak-ccard-label">Jam Pelayanan</p>
                                <p class="kontak-ccard-value">{{ $desa->jam_pelayanan }}</p>
                            </div>
                        </div>
                    @endif

                    @if($desa->email)
                        <div class="kontak-ccard">
                            <div class="kontak-ccard-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <p class="kontak-ccard-label">Email</p>
                                <p class="kontak-ccard-value">{{ $desa->email }}</p>
                            </div>
                        </div>
                    @endif

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

@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};

    // Override filter element IDs for Peta Desa
    document.addEventListener('DOMContentLoaded', function () {
        var mapEl = document.getElementById('map-desa');
        if (mapEl) {
            mapEl.setAttribute('id', 'map-desa');
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