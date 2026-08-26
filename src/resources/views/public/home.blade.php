@extends('layouts.public')

@section('title', ($desa?->nama_desa ?? 'Desa Bendung') . ' — Portal Informasi')
@push('meta')
    <meta name="description" content="Portal informasi publik {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Temukan profil desa, dusun aktif, UMKM, fasilitas, agenda kegiatan, pengumuman, dan peta lokasi.">
@endpush

@section('content')
<div class="page-home">

    {{-- HERO --}}
    <section
        class="home-hero"
        id="beranda"
        aria-labelledby="hero-heading"
        @if($desa?->banner_path)
            style="--hero-image: url('{{ asset('storage/' . $desa->banner_path) }}');"
        @endif
    >
        <div class="container home-hero-inner">
            <div class="home-hero-copy" data-reveal>
                <p class="home-hero-eyebrow">Portal Informasi Desa</p>
                <h1 class="home-hero-title" id="hero-heading">
                    Portal Informasi<br>{{ $desa?->nama_desa ?? 'Desa Bendung' }}
                </h1>
                <p class="home-hero-desc">
                    {{ $desa?->deskripsi_singkat ?? 'Akses informasi desa dan dusun dalam satu portal yang jelas dan mudah digunakan.' }}
                </p>
            </div>
        </div>
        <span class="home-visual-ref">Visual wilayah desa</span>
    </section>

    {{-- QUICK ACCESS --}}
    <nav class="quick-nav-section home-quick-nav" aria-label="Akses cepat halaman">
        <div class="container">
            <div class="quick-nav-grid home-grid" role="list">
                <a href="#dusun" class="quick-nav-card" role="listitem">
                    <span class="quick-nav-iconbox" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11.5 12 4l9 7.5"/><path d="M5 10.5V20h14v-9.5"/><path d="M9 20v-6h6v6"/></svg>
                    </span>
                    <strong class="quick-nav-label">Dusun</strong>
                    <span class="quick-nav-arrow" aria-hidden="true">↗</span>
                </a>

                <a href="#informasi-desa" class="quick-nav-card" role="listitem">
                    <span class="quick-nav-iconbox" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8M8 11h8M8 15h5"/></svg>
                    </span>
                    <strong class="quick-nav-label">Informasi</strong>
                    <span class="quick-nav-arrow" aria-hidden="true">↗</span>
                </a>

                <a href="#pengumuman" class="quick-nav-card" role="listitem">
                    <span class="quick-nav-iconbox" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m4 13 12-5v10L4 13Z"/><path d="M16 10h3M16 16h3M7 14.5l1.5 4"/></svg>
                    </span>
                    <strong class="quick-nav-label">Pengumuman</strong>
                    <span class="quick-nav-arrow" aria-hidden="true">↗</span>
                </a>

                <a href="#agenda" class="quick-nav-card" role="listitem">
                    <span class="quick-nav-iconbox" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/></svg>
                    </span>
                    <strong class="quick-nav-label">Agenda</strong>
                    <span class="quick-nav-arrow" aria-hidden="true">↗</span>
                </a>

                <a href="#peta-desa" class="quick-nav-card" role="listitem">
                    <span class="quick-nav-iconbox" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s6-5.2 6-11a6 6 0 1 0-12 0c0 5.8 6 11 6 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    </span>
                    <strong class="quick-nav-label">Peta</strong>
                    <span class="quick-nav-arrow" aria-hidden="true">↗</span>
                </a>

                <a href="#kontak-desa" class="quick-nav-card" role="listitem">
                    <span class="quick-nav-iconbox" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7"/></svg>
                    </span>
                    <strong class="quick-nav-label">Kontak</strong>
                    <span class="quick-nav-arrow" aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- PILIHAN DUSUN --}}
    <section class="section-dusun" id="dusun" aria-labelledby="dusun-heading">
        <div class="bridge-handle" aria-hidden="true"></div>
        <div class="container">
            <div class="home-section-centered" data-reveal>
                <h2 class="section-title" id="dusun-heading">Pilihan Dusun</h2>
                <p class="home-section-subtitle">Pilih dusun untuk melihat profil wilayah</p>
            </div>

            @if($dusuns->isEmpty())
                <x-partials.empty-state label="Belum ada Dusun aktif yang terdaftar." />
            @else
                <div class="dusun-grid" data-reveal role="list">
                    @foreach($dusuns as $index => $dusun)
                        <a href="{{ route('dusun.show', $dusun->id) }}" class="dusun-card" id="dusun-card-{{ $dusun->id }}" role="listitem">
                            <div class="dusun-card-header">
                                <span class="dusun-card-num" aria-hidden="true">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="dusun-card-arrow" aria-hidden="true">→</span>
                            </div>
                            <strong class="dusun-card-name">{{ $dusun->nama_dusun }}</strong>
                            <span class="dusun-card-cta">Lihat profil</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- INFORMASI DESA --}}
    <section class="section-info-desa" id="informasi-desa" aria-labelledby="info-desa-heading">
        <div class="container">
            <div class="home-section-centered" data-reveal>
                <h2 class="section-title" id="info-desa-heading">Informasi Desa</h2>
            </div>

            <div class="home-info-grid" data-reveal>
                <article class="home-info-card">
                    <div class="home-info-card-top">
                        <span class="home-info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"/></svg>
                        </span>
                        <h3 class="home-info-name">Tentang Desa</h3>
                    </div>
                    <p class="home-info-text">
                        {{ $desa?->deskripsi_singkat ?? 'Deskripsi dan profil resmi desa belum tersedia.' }}
                    </p>
                    @if($desa?->nama_kepala_desa)
                        <p class="home-info-meta">Kepala Desa: {{ $desa->nama_kepala_desa }}</p>
                    @endif
                </article>

                <article class="home-info-card">
                    <div class="home-info-card-top">
                        <span class="home-info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        </span>
                        <h3 class="home-info-name">Informasi Pelayanan</h3>
                    </div>
                    <p class="home-info-text">
                        @if($desa?->jam_pelayanan)
                            {{ $desa->jam_pelayanan }}
                        @else
                            Informasi jam pelayanan belum tersedia.
                        @endif
                    </p>
                    @if($desa?->alamat_kantor)
                        <p class="home-info-meta">{{ $desa->alamat_kantor }}</p>
                    @endif
                </article>

                <article class="home-info-card">
                    <div class="home-info-card-top">
                        <span class="home-info-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7"/></svg>
                        </span>
                        <h3 class="home-info-name">Kontak Resmi</h3>
                    </div>
                    <p class="home-info-text">
                        {{ $desa?->nomor_kontak ?? 'Nomor kontak desa belum tersedia.' }}
                    </p>
                    @if($desa?->email)
                        <p class="home-info-meta">{{ $desa->email }}</p>
                    @endif
                </article>
            </div>
        </div>
    </section>

    {{-- PENGUMUMAN + AGENDA --}}
    <section class="home-updates" aria-label="Pengumuman dan Agenda Desa">
        <div class="container home-updates-grid">
            <div class="home-update-col" id="pengumuman" aria-labelledby="pengumuman-heading">
                <div class="section-head">
                    <h2 class="section-title" id="pengumuman-heading">Pengumuman</h2>
                    <a href="{{ route('pengumuman.arsip') }}" class="see-all">Lihat Semua →</a>
                </div>

                @if($pengumumans->isEmpty())
                    <x-partials.empty-state label="Belum ada pengumuman aktif." />
                @else
                    <div class="timeline" data-reveal>
                        @foreach($pengumumans as $p)
                            @php $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); @endphp
                            <article class="timeline-item">
                                <div class="timeline-icon" aria-hidden="true">📣</div>
                                <div>
                                    <div class="meta">
                                        <span class="date">{{ $pDate->isoFormat('D MMM YYYY') }}</span>
                                        <span class="badge">Warta Resmi</span>
                                        @if($p->tanggal_kedaluwarsa)
                                            <span class="subtle">s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                        @endif
                                    </div>
                                    <h3 class="item-title">
                                        <a href="{{ route('pengumuman.show', $p->id) }}">{{ $p->judul }}</a>
                                    </h3>
                                </div>
                                <a href="{{ route('pengumuman.show', $p->id) }}" class="arrow" aria-label="Baca pengumuman: {{ $p->judul }}">›</a>
                            </article>
                        @endforeach
                    </div>
                    <a class="outline-btn" href="{{ route('pengumuman.arsip') }}">Lihat Semua Pengumuman</a>
                @endif
            </div>

            <div class="home-update-col" id="agenda" aria-labelledby="agenda-heading">
                <div class="section-head">
                    <h2 class="section-title" id="agenda-heading">Agenda / Kegiatan</h2>
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
                            <article class="timeline-item">
                                <div class="timeline-icon green" aria-hidden="true">📅</div>
                                <div>
                                    <div class="meta">
                                        <span class="date">{{ $startDate->isoFormat('D MMM') }}</span>
                                        <x-partials.status-badge :status="$status" />
                                        @if($ag->lokasi_text)
                                            <span class="subtle">{{ $ag->lokasi_text }}</span>
                                        @endif
                                    </div>
                                    <h3 class="item-title">
                                        <a href="{{ route('agenda.show', $ag->id) }}">{{ $ag->judul }}</a>
                                    </h3>
                                </div>
                                <a href="{{ route('agenda.show', $ag->id) }}" class="arrow" aria-label="Lihat agenda: {{ $ag->judul }}">›</a>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- PETA + KONTAK --}}
    <section class="home-map-contact" aria-label="Peta dan Kontak Desa">
        <div class="container home-map-contact-grid">

            <div class="home-map-box" id="peta-desa">
                <div class="section-head">
                    <h2 class="section-title">Peta Desa</h2>
                </div>

                <div class="map-card" data-reveal>
                    <div class="map-toolbar">
                        <div class="field">
                            <label for="map-desa-filter-dusun">Dusun</label>
                            <select id="map-desa-filter-dusun" aria-label="Filter berdasarkan Dusun">
                                <option value="semua">Semua</option>
                                @foreach($dusunFilterOptions as $opt)
                                    <option value="{{ $opt['id'] }}">{{ $opt['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label for="map-desa-filter-cat">Kategori</label>
                            <select id="map-desa-filter-cat" aria-label="Filter berdasarkan Kategori">
                                <option value="semua">Semua</option>
                                @foreach($categoryOptions as $cat)
                                    <option value="{{ e($cat) }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="map-frame">
                        <div
                            id="map-desa"
                            data-map
                            style="height:100%;width:100%;"
                            aria-label="Peta Desa dengan marker lokasi"
                            role="img"
                        ></div>
                    </div>

                    <div class="map-footer">
                        <div class="map-legend">
                            <span class="legend-item"><span class="legend-dot dot-umkm" aria-hidden="true"></span>UMKM</span>
                            <span class="legend-item"><span class="legend-dot dot-service" aria-hidden="true"></span>Pelayanan</span>
                            <span class="legend-item"><span class="legend-dot dot-facility" aria-hidden="true"></span>Fasilitas</span>
                        </div>
                        <div class="caption">Peta Desa — {{ $desa?->nama_desa ?? 'Desa Bendung' }}</div>
                    </div>
                </div>
            </div>

            <div class="home-contact-box" id="kontak-desa" aria-labelledby="kontak-heading">
                <div class="home-block-title">
                    <h2 class="section-title" id="kontak-heading">Kontak Desa</h2>
                </div>

                @if($desa)
                    <div class="home-contact-grid" data-reveal>
                        @if($desa->nomor_kontak)
                            <article class="home-contact-card">
                                <span class="home-contact-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7"/></svg>
                                </span>
                                <strong class="home-contact-label">WhatsApp / Telepon</strong>
                                <span class="home-contact-value">{{ $desa->nomor_kontak }}</span>
                                <div class="home-contact-action">
                                    <x-partials.whatsapp-btn :nomor="$desa->nomor_kontak" label="Hubungi" />
                                </div>
                            </article>
                        @endif

                        @if($desa->alamat_kantor)
                            <article class="home-contact-card">
                                <span class="home-contact-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                </span>
                                <strong class="home-contact-label">Alamat Kantor</strong>
                                <span class="home-contact-value">{{ $desa->alamat_kantor }}</span>
                            </article>
                        @endif

                        @if($desa->jam_pelayanan)
                            <article class="home-contact-card">
                                <span class="home-contact-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                </span>
                                <strong class="home-contact-label">Jam Pelayanan</strong>
                                <span class="home-contact-value">{{ $desa->jam_pelayanan }}</span>
                            </article>
                        @endif

                        @if($desa->email)
                            <article class="home-contact-card">
                                <span class="home-contact-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                                </span>
                                <strong class="home-contact-label">Email Resmi</strong>
                                <span class="home-contact-value">{{ $desa->email }}</span>
                            </article>
                        @endif
                    </div>
                @else
                    <x-partials.empty-state label="Informasi kontak Desa belum tersedia." />
                @endif
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};
    // map.js automatically initializes every [data-map] element on DOMContentLoaded.
</script>
@endpush