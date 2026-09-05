@extends('layouts.public')

@section('title', ($desa?->nama_desa ?? 'Desa Bendung') . ' | Portal Informasi')
@push('meta')
    <meta name="description" content="Portal informasi publik {{ $desa?->nama_desa ?? 'Desa Bendung' }}. Temukan profil desa, dusun aktif, UMKM, fasilitas, agenda kegiatan, pengumuman, dan peta lokasi.">
@endpush

@section('content')
<div class="page-home">

    @php
        $heroBgUrl = $desa?->banner_path 
            ? asset('storage/' . $desa->banner_path) 
            : asset('images/balai-desa-bendung.webp');
    @endphp

    {{-- HERO SECTION: CINEMATIC LIGHTING (DARK LEFT FOR TEXT, BRIGHT RIGHT FOR BALAI DESA) --}}
    <section
        class="home-hero"
        id="beranda"
        aria-labelledby="hero-title"
        style="--hero-bg: url('{{ $heroBgUrl }}');"
    >
        <div class="container hero-container">
            <div class="hero-inner">
                
                <div class="hero-eyebrow-row">
                    <span class="hero-gold-dash" aria-hidden="true"></span>
                    <span class="hero-eyebrow-text">PORTAL INFORMASI DESA</span>
                </div>

                <h1 class="hero-title" id="hero-title">
                    Portal Informasi<br>{{ $desa?->nama_desa ?? 'Desa Bendung' }}
                </h1>

                <div class="hero-gold-bar" aria-hidden="true"></div>

                <p class="hero-desc">
                    {{ $desa?->deskripsi_singkat ?? 'Portal Informasi Resmi Pemerintah Desa Bendung, Kecamatan Jetis, Kabupaten Mojokerto, Jawa Timur.' }}
                </p>

            </div>
        </div>
    </section>

    {{-- QUICK NAVIGATION DOCK (PILL DOCK - ANTI WORD-BREAK) --}}
    <section class="quick-dock-section" aria-label="Akses Cepat Halaman">
        <div class="container">
            <div class="quick-dock-card" role="list">
                
                <a href="#dusun" class="dock-item" role="listitem">
                    <div class="dock-icon-box" aria-hidden="true">🏡</div>
                    <strong class="dock-label">Dusun</strong>
                </a>

                <a href="#informasi-desa" class="dock-item" role="listitem">
                    <div class="dock-icon-box" aria-hidden="true">📄</div>
                    <strong class="dock-label">Informasi</strong>
                </a>

                <a href="#pengumuman" class="dock-item" role="listitem">
                    <div class="dock-icon-box" aria-hidden="true">📢</div>
                    <strong class="dock-label">Pengumuman</strong>
                </a>

                <a href="#agenda" class="dock-item" role="listitem">
                    <div class="dock-icon-box" aria-hidden="true">📅</div>
                    <strong class="dock-label">Agenda</strong>
                </a>

                <a href="#peta-desa" class="dock-item" role="listitem">
                    <div class="dock-icon-box" aria-hidden="true">🗺️</div>
                    <strong class="dock-label">Peta Desa</strong>
                </a>

                <a href="#kontak-desa" class="dock-item" role="listitem">
                    <div class="dock-icon-box" aria-hidden="true">📞</div>
                    <strong class="dock-label">Kontak</strong>
                </a>

            </div>
        </div>
    </section>

    {{-- PILIHAN DUSUN --}}
    <section class="section-wrapper" id="dusun" aria-labelledby="dusun-heading">
        <div class="container">
            
            <div class="section-head">
                <div>
                    <span class="section-eyebrow">Wilayah Administratif</span>
                    <h2 class="section-title" id="dusun-heading">Pilihan Dusun</h2>
                    <p class="section-subtitle">Pilih salah satu dari padukuhan untuk melihat profil dan potensi wilayah</p>
                </div>
                <a href="#peta-desa" class="section-action-link">Lihat Peta Sebaran Dusun →</a>
            </div>

            @if($dusuns->isEmpty())
                <x-partials.empty-state label="Belum ada Dusun aktif yang terdaftar." />
            @else
                <div class="dusun-grid" role="list">
                    @foreach($dusuns as $index => $dusun)
                        <a href="{{ route('dusun.show', $dusun->id) }}" class="dusun-card" id="dusun-card-{{ $dusun->id }}" role="listitem">
                            <div class="dusun-card-top">
                                <div class="dock-icon-box" aria-hidden="true">🏡</div>
                                <span class="dusun-num-badge">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h3 class="dusun-name">{{ $dusun->nama_dusun }}</h3>
                            <p class="dusun-desc">{{ $dusun->deskripsi_singkat ?? 'Pusat kegiatan masyarakat dan potensi wilayah.' }}</p>
                            <div class="dusun-card-foot">
                                <span>Lihat Profil Dusun</span>
                                <span aria-hidden="true">→</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- INFORMASI DESA: HORIZONTAL 3-CARD ROW ON DARK FOREST GREEN --}}
    <section class="section-info-dark" id="informasi-desa" aria-labelledby="info-heading">
        <div class="container">
            
            <div class="info-dark-head">
                <h2 class="info-dark-title" id="info-heading">Informasi Desa</h2>
                <div class="info-dark-gold-bar" aria-hidden="true"></div>
            </div>

            <div class="info-horizontal-grid">
                
                <!-- Card 1: Tentang Desa -->
                <article class="info-h-card" onclick="openDetailModal('Tentang {{ $desa?->nama_desa ?? 'Desa Bendung' }}', 'Profil & Pemangku Wilayah', '{{ addslashes($desa?->deskripsi_singkat ?? 'Pemerintah Desa Bendung berkomitmen mewujudkan desa yang transparan, mandiri, dan melayani warga secara adil.') }}')">
                    <div class="dock-icon-box info-h-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <h3 class="info-h-name">Tentang Desa</h3>
                    <p class="info-h-sub">{{ $desa?->nama_desa ?? 'Desa Bendung' }}</p>
                    <span class="info-h-cta">Buka Profil →</span>
                </article>

                <!-- Card 2: Informasi Pelayanan -->
                <article class="info-h-card" onclick="openDetailModal('Informasi Pelayanan', 'Layanan Balai Desa', 'Pelayanan loket administrasi dan perizinan kantor desa:\n\n• Jam Pelayanan: {{ addslashes($desa?->jam_pelayanan ?? 'Senin - Jumat: 08:00 - 15:00 WIB') }}\n• Alamat: {{ addslashes($desa?->alamat_kantor ?? 'Balai Desa') }}\n\nUntuk pengurusan administrasi, silakan membawa berkas KTP dan KK asli.')">
                    <div class="dock-icon-box info-h-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3 class="info-h-name">Informasi Pelayanan</h3>
                    <p class="info-h-sub">{{ $desa?->jam_pelayanan ?? 'Senin - Jumat: 08:00 - 15:00 WIB' }}</p>
                    <span class="info-h-cta">Jadwal & Syarat →</span>
                </article>

                <!-- Card 3: Kontak Resmi -->
                <article class="info-h-card" onclick="openDetailModal('Kontak Resmi Kalurahan', 'Akses Pelayanan Cepat', 'Hubungi loket administrasi Pemerintah {{ addslashes($desa?->nama_desa ?? 'Desa Bendung') }}:\n\n• Telepon / WhatsApp: {{ addslashes($desa?->nomor_kontak ?? '-') }}\n• Email: {{ addslashes($desa?->email ?? '-') }}\n• Alamat: {{ addslashes($desa?->alamat_kantor ?? '-') }}')">
                    <div class="dock-icon-box info-h-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7"/>
                        </svg>
                    </div>
                    <h3 class="info-h-name">Kontak Resmi</h3>
                    <p class="info-h-sub">{{ $desa?->nomor_kontak ?? 'Nomor kontak desa' }}</p>
                    <span class="info-h-cta">Hubungi Loket →</span>
                </article>

            </div>

        </div>
    </section>

    {{-- WARTA PENGUMUMAN & AGENDA (DUAL COLUMN) --}}
    <section class="section-wrapper" id="warta" aria-labelledby="warta-heading">
        <div class="container">
            
            <div class="updates-dual-grid">
                
                <!-- Kolom Pengumuman -->
                <div class="update-box" id="pengumuman">
                    <div class="update-box-head">
                        <h2 class="update-box-title" id="warta-heading">
                            <span aria-hidden="true">📢</span> Warta Pengumuman
                        </h2>
                        <a href="{{ route('pengumuman.arsip') }}" class="section-action-link">Semua Warta →</a>
                    </div>

                    @if($pengumumans->isEmpty())
                        <x-partials.empty-state label="Belum ada pengumuman aktif." />
                    @else
                        <div class="update-list">
                            @foreach($pengumumans as $p)
                                @php 
                                    $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); 
                                @endphp
                                <a href="{{ route('pengumuman.show', $p->id) }}" class="update-item" aria-label="Baca pengumuman: {{ $p->judul }}">
                                    <div class="update-date-badge" aria-hidden="true">
                                        <span class="date-day">{{ $pDate->format('d') }}</span>
                                        <span class="date-mon">{{ $pDate->isoFormat('MMM') }}</span>
                                    </div>
                                    <div class="update-content">
                                        <div class="update-meta-row">
                                            <span class="update-pill pill-official">Warta Resmi</span>
                                            @if($p->tanggal_kedaluwarsa)
                                                <span class="subtle" style="font-size:11px;color:var(--text-muted)">s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                            @endif
                                        </div>
                                        <h3 class="update-item-title">{{ $p->judul }}</h3>
                                        <p class="update-item-sub">Lihat warta pengumuman lengkap →</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Kolom Agenda Kegiatan -->
                <div class="update-box" id="agenda" aria-labelledby="agenda-heading">
                    <div class="update-box-head">
                        <h2 class="update-box-title" id="agenda-heading">
                            <span aria-hidden="true">📅</span> Agenda Kegiatan
                        </h2>
                        <span style="font-size:12px;font-weight:700;color:var(--forest-700)">{{ \Illuminate\Support\Carbon::now()->locale('id')->isoFormat('MMMM YYYY') }}</span>
                    </div>

                    @if($agendas->isEmpty())
                        <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
                    @else
                        <div class="update-list">
                            @foreach($agendas as $ag)
                                @php
                                    $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                                    $status = $ag->effectiveStatusFor($now);
                                    $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                                @endphp
                                <a href="{{ route('agenda.show', $ag->id) }}" class="update-item" aria-label="Lihat agenda: {{ $ag->judul }}">
                                    <div class="update-date-badge" aria-hidden="true">
                                        <span class="date-day">{{ $startDate->format('d') }}</span>
                                        <span class="date-mon">{{ $startDate->isoFormat('MMM') }}</span>
                                    </div>
                                    <div class="update-content">
                                        <div class="update-meta-row">
                                            <x-partials.status-badge :status="$status" />
                                            @if($ag->lokasi_text)
                                                <span style="font-size:11px;color:var(--text-muted)">{{ $ag->lokasi_text }}</span>
                                            @endif
                                        </div>
                                        <h3 class="update-item-title">{{ $ag->judul }}</h3>
                                        <p class="update-item-sub">Lihat detail agenda kegiatan →</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </section>

    {{-- PETA WILAYAH DESA INTERAKTIF --}}
    <section class="section-wrapper" id="peta-desa" aria-labelledby="peta-heading">
        <div class="container">
            
            <div class="section-head">
                <div>
                    <span class="section-eyebrow">Geospasial & Fasilitas</span>
                    <h2 class="section-title" id="peta-heading">Peta Wilayah Desa</h2>
                    <p class="section-subtitle">Titik lokasi balai desa, sebaran padukuhan, fasilitas, dan sentra UMKM</p>
                </div>
            </div>

            <div class="map-section-card">
                
                <div class="map-filter-bar">
                    <div class="filter-group">
                        <label for="map-desa-filter-dusun" class="filter-label">Filter Dusun:</label>
                        <select id="map-desa-filter-dusun" class="filter-select" aria-label="Filter berdasarkan Dusun">
                            <option value="semua">Semua Dusun</option>
                            @foreach($dusunFilterOptions as $opt)
                                <option value="{{ $opt['id'] }}">{{ $opt['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="map-desa-filter-cat" class="filter-label">Kategori:</label>
                        <select id="map-desa-filter-cat" class="filter-select" aria-label="Filter berdasarkan Kategori">
                            <option value="semua">Semua Kategori</option>
                            @foreach($categoryOptions as $cat)
                                <option value="{{ e($cat) }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Leaflet Map Container -->
                <div class="map-container-frame">
                    <div
                        id="map-desa"
                        data-map
                        style="height:100%;width:100%;"
                        aria-label="Peta Desa dengan marker lokasi"
                        role="application"
                    ></div>
                </div>

                <div class="map-legend-row">
                    <div class="legend-items">
                        <div class="legend-chip">
                            <span class="legend-dot dot-kantor" aria-hidden="true"></span>
                            <span>Pelayanan & Kantor</span>
                        </div>
                        <div class="legend-chip">
                            <span class="legend-dot dot-umkm" aria-hidden="true"></span>
                            <span>Sentra UMKM</span>
                        </div>
                        <div class="legend-chip">
                            <span class="legend-dot dot-fasilitas" aria-hidden="true"></span>
                            <span>Fasilitas Publik</span>
                        </div>
                    </div>
                    <span>Peta Interaktif {{ $desa?->nama_desa ?? 'Desa Bendung' }}</span>
                </div>

            </div>

        </div>
    </section>

    {{-- KONTAK DESA (2x2 COMPACT GRID) --}}
    <section class="section-wrapper" id="kontak-desa" aria-labelledby="kontak-heading">
        <div class="container">
            
            <div class="contact-head-block">
                <h2 class="contact-title-main" id="kontak-heading">Kontak Desa</h2>
                <div class="contact-gold-line" aria-hidden="true"></div>
            </div>

            @if($desa)
                <div class="home-contact-grid">
                    
                    @if($desa->nomor_kontak)
                        <!-- Card 1: WhatsApp / Telepon -->
                        <article class="home-contact-card">
                            <div class="dock-icon-box home-contact-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7"/>
                                </svg>
                            </div>
                            <strong class="home-contact-label">WhatsApp / Telepon</strong>
                            <span class="home-contact-value">{{ $desa->nomor_kontak }}</span>
                            <div class="home-contact-action">
                                @php
                                    $cleanWa = preg_replace('/[^0-9]/', '', $desa->nomor_kontak);
                                    if (str_starts_with($cleanWa, '0')) {
                                        $cleanWa = '62' . substr($cleanWa, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $cleanWa }}" target="_blank" rel="noopener" class="home-wa-btn" aria-label="Hubungi WhatsApp Desa">
                                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                                    </svg>
                                    <span>Hubungi</span>
                                </a>
                            </div>
                        </article>
                    @endif

                    @if($desa->alamat_kantor)
                        <!-- Card 2: Alamat Kantor -->
                        <article class="home-contact-card">
                            <div class="dock-icon-box home-contact-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="2.5"/>
                                </svg>
                            </div>
                            <strong class="home-contact-label">Alamat Kantor</strong>
                            <span class="home-contact-value">{{ $desa->alamat_kantor }}</span>
                        </article>
                    @endif

                    @if($desa->jam_pelayanan)
                        <!-- Card 3: Jam Pelayanan -->
                        <article class="home-contact-card">
                            <div class="dock-icon-box home-contact-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            </div>
                            <strong class="home-contact-label">Jam Pelayanan</strong>
                            <span class="home-contact-value">{{ $desa->jam_pelayanan }}</span>
                        </article>
                    @endif

                    @if($desa->email)
                        <!-- Card 4: Email Resmi -->
                        <article class="home-contact-card">
                            <div class="dock-icon-box home-contact-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="m3 7 9 6 9-6"/>
                                </svg>
                            </div>
                            <strong class="home-contact-label">Email Resmi</strong>
                            <span class="home-contact-value">{{ $desa->email }}</span>
                        </article>
                    @endif

                </div>
            @else
                <x-partials.empty-state label="Informasi kontak Desa belum tersedia." />
            @endif

        </div>
    </section>

    <!-- INTERACTIVE MODAL DETAIL -->
    <div class="modal-overlay" id="modal-overlay" onclick="closeDetailModal(event)">
        <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modal-head">
            <button class="modal-close-btn" onclick="closeDetailModal()" aria-label="Tutup Jendela">✕</button>
            <span class="modal-header-tag" id="modal-tag">Informasi Wilayah</span>
            <h3 class="modal-heading" id="modal-head">Judul Informasi</h3>
            <p class="modal-lead" id="modal-sub">Wilayah {{ $desa?->nama_desa ?? 'Desa Bendung' }}</p>
            <div class="modal-info-box" id="modal-content">
                Deskripsi lengkap informasi terkait.
            </div>
            <button class="modal-action-btn" onclick="closeDetailModal()">Tutup Jendela</button>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};
</script>
@endpush