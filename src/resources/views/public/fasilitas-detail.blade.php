@extends('layouts.public')

@section('title', $fasilitas->nama . ' — Fasilitas — Portal Informasi')
@push('meta')
    <meta name="description" content="{{ $fasilitas->nama }}: {{ $fasilitas->kategoriFasilitas?->nama_kategori ?? 'Fasilitas' }} di {{ $fasilitas->dusun?->nama_dusun ?? 'Desa Bendung' }}.">
@endpush

@section('content')

<div class="section-public">
    <div class="container-narrow">

        {{-- Back link --}}
        <a href="{{ route('dusun.show', $fasilitas->dusun_id) }}#fasilitas" class="back-link mb-3" style="display:inline-flex;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke Fasilitas
        </a>

        <div class="detail-grid" style="gap:var(--space-4);">

            {{-- Left: Media --}}
            <div>
                <x-partials.media-placeholder
                    :src="$fasilitas->foto_path"
                    :alt="'Foto ' . $fasilitas->nama"
                    class="media-img"
                />
            </div>

            {{-- Right: Info --}}
            <div style="display:flex;flex-direction:column;gap:var(--space-2);">
                <h1 class="detail-title" style="margin-bottom:4px;">{{ $fasilitas->nama }}</h1>

                @if($fasilitas->kategoriFasilitas)
                    <span class="badge badge-kategori" style="align-self:flex-start;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        {{ $fasilitas->kategoriFasilitas->nama_kategori }}
                    </span>
                @endif

                @if($fasilitas->deskripsi)
                    <div>
                        <p class="info-label">Deskripsi</p>
                        <p class="info-value" style="line-height:1.7;margin-top:4px;">{{ $fasilitas->deskripsi }}</p>
                    </div>
                @endif

                <div>
                    <p class="info-label">Alamat</p>
                    <p class="info-value" style="margin-top:4px;">{{ $fasilitas->alamat ?? '—' }}</p>
                </div>

                <div style="display:flex;flex-wrap:wrap;gap:var(--space-2);">
                    @if($fasilitas->dusun)
                        <div>
                            <p class="info-label">Dusun</p>
                            <p class="info-value">{{ $fasilitas->dusun->nama_dusun }}</p>
                        </div>
                    @endif
                    @if($fasilitas->latitude !== null && $fasilitas->longitude !== null)
                        <div>
                            <p class="info-label">Koordinat</p>
                            <p class="info-value">{{ $fasilitas->latitude }}, {{ $fasilitas->longitude }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Directions CTA --}}
        @if($directionsUrl)
            <div class="resource-row mt-3" style="flex-direction:column;align-items:flex-start;gap:var(--space-2);">
                <x-partials.directions-btn :lat="$fasilitas->latitude" :lng="$fasilitas->longitude" label="Buka Petunjuk Arah" class="w-full" />
                <p class="text-sage text-sm">Buka petunjuk arah menuju lokasi fasilitas menggunakan aplikasi peta pilihan Anda.</p>
            </div>
        @endif

        {{-- Optional WhatsApp --}}
        @if($fasilitas->nomor_whatsapp ?? null)
            <div class="mt-2">
                <x-partials.whatsapp-btn :nomor="$fasilitas->nomor_whatsapp" label="Hubungi via WhatsApp" />
            </div>
        @endif

    </div>
</div>

@endsection
