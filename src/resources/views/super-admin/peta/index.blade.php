@extends('layouts.super-admin')

@section('title', 'Peta Persebaran Sarana & Usaha')
@section('breadcrumb')
    <a href="{{ route('super-admin.dashboard') }}">Dashboard</a> / <span>Data / Peta</span>
@endsection

@section('content')
<div class="admin-page-header flex-between">
    <div>
        <h1 class="admin-page-title">Peta Persebaran Sarana & Usaha</h1>
        <p class="admin-page-desc">Proyeksi spasial lokasi fasilitas umum, titik usaha UMKM, dan kontak pelayanan warga.</p>
    </div>
</div>

<!-- Map Filter Controls -->
<div class="admin-card mb-3">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="GET" action="{{ route('super-admin.data-peta') }}" class="filter-form-bar">
            <div class="filter-group">
                <label for="dusun_id" class="filter-label">Wilayah Dusun:</label>
                <select name="dusun_id" id="dusun_id" class="form-select filter-select" onchange="this.form.submit()">
                    <option value="">-- Seluruh Dusun --</option>
                    @foreach($dusuns as $dusun)
                        <option value="{{ $dusun->id }}" {{ (string)$dusunFilter === (string)$dusun->id ? 'selected' : '' }}>
                            {{ $dusun->nama_dusun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="kategori" class="filter-label">Kategori / Lapisan Data:</label>
                <select name="kategori" id="kategori" class="form-select filter-select" onchange="this.form.submit()">
                    <option value="">-- Semua Lapisan Data --</option>
                    <optgroup label="Klasifikasi Fasilitas Umum">
                        @foreach($kategoriFasilitas as $kat)
                            <option value="fasilitas_{{ $kat->id }}" {{ $kategoriFilter === 'fasilitas_' . $kat->id ? 'selected' : '' }}>
                                Fasilitas: {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Sektor Lainnya">
                        <option value="umkm" {{ $kategoriFilter === 'umkm' ? 'selected' : '' }}>Usaha Warga (UMKM)</option>
                        <option value="pelayanan" {{ $kategoriFilter === 'pelayanan' ? 'selected' : '' }}>Kontak Pelayanan</option>
                    </optgroup>
                </select>
            </div>

            @if(!empty($dusunFilter) || !empty($kategoriFilter))
                <a href="{{ route('super-admin.data-peta') }}" class="btn btn-sm btn-secondary">Reset Filter</a>
            @endif
        </form>
    </div>
</div>

<!-- Map Container -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div id="superAdminMapCanvas" style="height: 620px; width: 100%; border-radius: inherit; z-index: 1;"></div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const markersData = @json($markers);
    const defaultCenter = [-7.9150, 110.5750]; // Titik tengah Desa Bendung

    const map = L.map('superAdminMapCanvas', {
        scrollWheelZoom: false
    }).setView(defaultCenter, 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const markerGroup = L.featureGroup();

    markersData.forEach(item => {
        if (!item.latitude || !item.longitude) return;

        const customMarker = L.circleMarker([item.latitude, item.longitude], {
            radius: 8,
            fillColor: item.color || '#2e5e3e',
            color: '#ffffff',
            weight: 2,
            opacity: 1,
            fillOpacity: 0.9
        });

        const popupContent = `
            <div class="map-popup-card">
                <div class="map-popup-type" style="color: ${item.color}; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
                    ${item.category}
                </div>
                <h4 style="margin: 0.25rem 0; font-size: 0.95rem; font-weight: 700; color: #1e293b;">
                    ${item.title}
                </h4>
                <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.5rem;">
                    Wilayah: <strong>${item.dusun}</strong>
                </div>
                <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 0.75rem;">
                    📍 ${item.latitude.toFixed(6)}, ${item.longitude.toFixed(6)}
                </div>
                <a href="${item.edit_url}" style="display: inline-block; background: #0f172a; color: #ffffff; padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.75rem; text-decoration: none; font-weight: 600;">
                    Kelola Data →
                </a>
            </div>
        `;

        customMarker.bindPopup(popupContent);
        markerGroup.addLayer(customMarker);
    });

    markerGroup.addTo(map);

    if (markersData.length > 0) {
        map.fitBounds(markerGroup.getBounds(), { padding: [40, 40], maxZoom: 16 });
    }
});
</script>
@endpush
@endsection
