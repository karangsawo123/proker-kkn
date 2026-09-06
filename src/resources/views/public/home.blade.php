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

                <a href="#pengumuman" class="dock-item" data-open-modal="modal-desa-pengumuman" role="button" aria-haspopup="dialog" aria-controls="modal-desa-pengumuman">
                    <div class="dock-icon-box" aria-hidden="true">
                        📢
                        @if(($pengumumanCount ?? $pengumumans->count()) > 0)
                            <span class="dock-badge" aria-label="{{ $pengumumanCount ?? $pengumumans->count() }} pengumuman">{{ $pengumumanCount ?? $pengumumans->count() }}</span>
                        @endif
                    </div>
                    <strong class="dock-label">Pengumuman</strong>
                </a>

                <a href="#agenda" class="dock-item" data-open-modal="modal-desa-agenda" role="button" aria-haspopup="dialog" aria-controls="modal-desa-agenda">
                    <div class="dock-icon-box" aria-hidden="true">
                        📅
                        @if(($agendaCount ?? $agendas->count()) > 0)
                            <span class="dock-badge" aria-label="{{ $agendaCount ?? $agendas->count() }} agenda">{{ $agendaCount ?? $agendas->count() }}</span>
                        @endif
                    </div>
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

    {{-- Backward compatibility anchors for hash links --}}
    <div id="warta" class="sr-only" aria-hidden="true"></div>
    <div id="pengumuman" class="sr-only" aria-hidden="true"></div>
    <div id="agenda" class="sr-only" aria-hidden="true"></div>

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
                                <option value="{{ $cat }}">{{ $cat }}</option>
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

    {{-- Backward compatibility anchor for hash links & test coverage --}}
    <div id="kontak-desa" class="sr-only" aria-hidden="true"></div>

    {{-- MODAL INTERAKTIF: WARTA PENGUMUMAN DESA --}}
    <div class="dusun-modal-backdrop" id="modal-desa-pengumuman" role="dialog" aria-modal="true" aria-labelledby="modal-desa-pengumuman-title" style="display: none;">
        <div class="dusun-modal-dialog">
            <div class="dusun-modal-handle" aria-hidden="true"></div>

            <div class="dusun-modal-header">
                <div class="dusun-modal-title-group">
                    <div class="dusun-modal-icon-badge yellow" aria-hidden="true">📢</div>
                    <div>
                        <h3 class="dusun-modal-title" id="modal-desa-pengumuman-title">Warta &amp; Pengumuman Desa</h3>
                        <p class="dusun-modal-subtitle">{{ $desa?->nama_desa ?? 'Pemerintah Desa Bendung' }}</p>
                    </div>
                </div>
                <div class="dusun-modal-header-actions">
                    @if(($pengumumanCount ?? $pengumumans->count()) > 0)
                        <span class="dusun-modal-count-pill">{{ $pengumumanCount ?? $pengumumans->count() }} Warta Aktif</span>
                    @endif
                    <button type="button" class="dusun-modal-close" data-close-modal="modal-desa-pengumuman" aria-label="Tutup jendela pengumuman">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div class="dusun-modal-body">
                @if($pengumumans->isEmpty())
                    <div class="dusun-modal-empty">
                        <x-partials.empty-state label="Belum ada pengumuman aktif." />
                    </div>
                @else
                    <div class="dusun-modal-list" role="list">
                        @foreach($pengumumans as $p)
                            @php $pDate = \Illuminate\Support\Carbon::parse($p->created_at)->locale('id'); @endphp
                            <a href="{{ route('pengumuman.show', $p->id) }}" class="dusun-modal-card-item" role="listitem">
                                <div class="dusun-modal-date-badge yellow" aria-hidden="true">
                                    <span class="dm-day">{{ $pDate->format('d') }}</span>
                                    <span class="dm-month">{{ $pDate->isoFormat('MMM') }}</span>
                                </div>
                                <div class="dusun-modal-card-content">
                                    <div class="dusun-modal-card-meta">
                                        <span class="dusun-modal-badge-warta">Warta Resmi</span>
                                        @if($p->tanggal_kedaluwarsa)
                                            <span class="dusun-modal-meta-exp">s.d {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                        @endif
                                    </div>
                                    <h4 class="dusun-modal-card-title">{{ $p->judul }}</h4>
                                </div>
                                <div class="dusun-modal-card-arrow" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="dusun-modal-footer">
                <a href="{{ route('pengumuman.arsip') }}" class="dusun-modal-btn-archive">
                    <span>Lihat Semua Arsip Pengumuman</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <button type="button" class="dusun-modal-btn-secondary" data-close-modal="modal-desa-pengumuman">Tutup</button>
            </div>
        </div>
    </div>

    {{-- MODAL INTERAKTIF: AGENDA KEGIATAN DESA --}}
    <div class="dusun-modal-backdrop" id="modal-desa-agenda" role="dialog" aria-modal="true" aria-labelledby="modal-desa-agenda-title" style="display: none;">
        <div class="dusun-modal-dialog">
            <div class="dusun-modal-handle" aria-hidden="true"></div>

            <div class="dusun-modal-header">
                <div class="dusun-modal-title-group">
                    <div class="dusun-modal-icon-badge" aria-hidden="true">📅</div>
                    <div>
                        <h3 class="dusun-modal-title" id="modal-desa-agenda-title">Agenda &amp; Kegiatan Desa</h3>
                        <p class="dusun-modal-subtitle">{{ $desa?->nama_desa ?? 'Pemerintah Desa Bendung' }}</p>
                    </div>
                </div>
                <div class="dusun-modal-header-actions">
                    @if(($agendaCount ?? $agendas->count()) > 0)
                        <span class="dusun-modal-count-pill">{{ $agendaCount ?? $agendas->count() }} Acara</span>
                    @endif
                    <button type="button" class="dusun-modal-close" data-close-modal="modal-desa-agenda" aria-label="Tutup jendela agenda">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div class="dusun-modal-body">
                @if($agendas->isEmpty())
                    <div class="dusun-modal-empty">
                        <x-partials.empty-state label="Belum ada agenda atau kegiatan." />
                    </div>
                @else
                    <div class="dusun-modal-list" role="list">
                        @foreach($agendas as $ag)
                            @php
                                $now = \Illuminate\Support\Carbon::now(config('app.business_timezone', 'Asia/Jakarta'));
                                $status = $ag->effectiveStatusFor($now);
                                $startDate = \Illuminate\Support\Carbon::parse($ag->tanggal_mulai)->locale('id');
                            @endphp
                            <a href="{{ route('agenda.show', $ag->id) }}" class="dusun-modal-card-item" role="listitem">
                                <div class="dusun-modal-date-badge" aria-hidden="true">
                                    <span class="dm-day">{{ $startDate->format('d') }}</span>
                                    <span class="dm-month">{{ $startDate->isoFormat('MMM') }}</span>
                                </div>
                                <div class="dusun-modal-card-content">
                                    <div class="dusun-modal-card-meta">
                                        <x-partials.status-badge :status="$status" />
                                        @if($ag->lokasi_text)
                                            <span class="dusun-modal-meta-location">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                                {{ $ag->lokasi_text }}
                                            </span>
                                        @endif
                                    </div>
                                    <h4 class="dusun-modal-card-title">{{ $ag->judul }}</h4>
                                </div>
                                <div class="dusun-modal-card-arrow" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="dusun-modal-footer">
                <button type="button" class="dusun-modal-btn-secondary" data-close-modal="modal-desa-agenda">Tutup Jendela</button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    window.MAP_CONFIG  = {!! $mapConfigJson !!};
    window.MAP_MARKERS = {!! $mapMarkersJson !!};

    // Modal Helper functions for Home
    function openHomeModal(modalId) {
        var modal = document.getElementById(modalId);
        if (!modal) return;
        modal.style.display = 'flex';
        requestAnimationFrame(function () {
            modal.classList.add('is-active');
            document.body.classList.add('dusun-modal-open');
        });
    }

    function closeHomeModal(modalId) {
        var modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.remove('is-active');
        document.body.classList.remove('dusun-modal-open');
        setTimeout(function () {
            if (!modal.classList.contains('is-active')) {
                modal.style.display = 'none';
            }
        }, 250);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Open modal triggers
        document.querySelectorAll('[data-open-modal]').forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                var modalId = this.getAttribute('data-open-modal');
                openHomeModal(modalId);
            });
        });

        // Close modal triggers
        document.querySelectorAll('[data-close-modal]').forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                var modalId = this.getAttribute('data-close-modal');
                closeHomeModal(modalId);
            });
        });

        // Backdrop click to close
        document.querySelectorAll('.dusun-modal-backdrop').forEach(function (backdrop) {
            backdrop.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeHomeModal(this.id);
                }
            });
        });

        // ESC key to close
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' || e.key === 'Esc') {
                var activeModal = document.querySelector('.dusun-modal-backdrop.is-active');
                if (activeModal) {
                    closeHomeModal(activeModal.id);
                }
            }
        });

        // URL hash auto-open support
        var hash = window.location.hash;
        if (hash === '#agenda') {
            openHomeModal('modal-desa-agenda');
        } else if (hash === '#pengumuman' || hash === '#warta') {
            openHomeModal('modal-desa-pengumuman');
        }
    });
</script>
@endpush