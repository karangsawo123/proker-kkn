@extends('layouts.public')

@section('title', $dusun->nama_dusun . ' — Portal Informasi ' . 'Desa Bendung')
@push('meta')
    <meta name="description" content="Halaman informasi publik {{ $dusun->nama_dusun }}: profil, kepala dusun, kontak pelayanan, UMKM, fasilitas, agenda, dan pengumuman.">
@endpush

@section('content')
<div class="page-dusun">

    {{-- HERO DUSUN --}}
    <header
        class="dusun-hero"
        id="header-dusun"
        aria-labelledby="dusun-page-title"
        @if($dusun->banner_path)
            style="--dusun-hero-image: url('{{ asset('storage/' . $dusun->banner_path) }}');"
        @endif
    >
        <div class="container">
            <div class="dusun-hero-lockup" data-reveal>
                <a href="{{ route('home') }}#dusun" class="dusun-hero-back">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
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

    {{-- QUICK NAVIGATION — IDs/classes retained for app.js scrollspy --}}
    <nav class="quick-nav" aria-label="Navigasi cepat halaman {{ $dusun->nama_dusun }}">
        <div class="container quick-nav-container">
            <button type="button" class="quick-nav-arrow quick-nav-arrow-prev" aria-label="Geser navigasi ke kiri" title="Geser ke kiri">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
            </button>

            <ul class="quick-nav-list" role="list">
                <li><a href="#profil-dusun" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">01</span>Profil Dusun</a></li>
                <li><a href="#peta-dusun" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">02</span>Peta Dusun</a></li>
                <li><a href="#kontak-pelayanan" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">03</span>Pelayanan</a></li>
                <li><a href="#umkm" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">04</span>UMKM</a></li>
                <li><a href="#fasilitas" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">05</span>Fasilitas</a></li>
                <li><a href="#agenda" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">06</span>Agenda</a></li>
                <li><a href="#pengumuman" class="quick-nav-link"><span class="quick-nav-num" aria-hidden="true">07</span>Pengumuman</a></li>
            </ul>

            <button type="button" class="quick-nav-arrow quick-nav-arrow-next" aria-label="Geser navigasi ke kanan" title="Geser ke kanan">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>
    </nav>

    {{-- PROFIL DUSUN --}}
    <section class="section-tentang" id="profil-dusun" aria-labelledby="profil-heading">
        <div class="container">
            <div class="about" data-reveal>
                <h2 id="profil-heading">Profil Dusun</h2>

                @if($dusun->deskripsi_singkat)
                    <p class="lead">{{ $dusun->deskripsi_singkat }}</p>
                @else
                    <x-partials.empty-state label="Profil Dusun belum tersedia." />
                @endif

                <div class="stats">
                    <div class="stat">
                        <small>Rukun Tetangga</small>
                        <b>{{ $dusun->jumlah_rt }} RT</b>
                    </div>

                    <div class="stat">
                        <small>Rukun Warga</small>
                        <b>{{ $dusun->jumlah_rw }} RW</b>
                    </div>

                    <div class="stat">
                        <small>Fasilitas Umum</small>
                        <b>{{ $fasilitas->count() }} Titik</b>
                    </div>

                    <div class="stat">
                        <small>UMKM</small>
                        <b>{{ $umkms->count() }} Usaha</b>
                    </div>
                </div>

                <div class="head">
                    <small>Kepala Dusun</small>
                    <strong>{{ $dusun->nama_kepala_dusun }}</strong>
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
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M7 17 17 7M8 7h9v9"/></svg>
                            </a>
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

</div>
@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};
    // map.js automatically initializes every [data-map] element on DOMContentLoaded.
</script>
@endpush