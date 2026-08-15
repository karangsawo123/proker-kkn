@extends('layouts.public')

@section('title', $umkm->nama_umkm . ' — UMKM — Portal Informasi')
@push('meta')
    <meta name="description" content="{{ $umkm->nama_umkm }}: {{ $umkm->jenis_usaha }} di {{ $umkm->dusun?->nama_dusun ?? 'Desa Bendung' }}.">
@endpush

@section('content')

<div class="section-public">
    <div class="container-narrow">

        {{-- Back link --}}
        <a href="{{ route('dusun.show', $umkm->dusun_id) }}#umkm" class="back-link mb-3" style="display:inline-flex;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke UMKM
        </a>

        <div class="detail-grid" style="gap:var(--space-4);">

            {{-- Left: Media --}}
            <div>
                <x-partials.media-placeholder
                    :src="$umkm->foto_utama_path"
                    :alt="'Foto ' . $umkm->nama_umkm"
                    class="media-img"
                />
            </div>

            {{-- Right: Info + Actions --}}
            <div style="display:flex;flex-direction:column;gap:var(--space-2);">
                <h1 class="detail-title" style="margin-bottom:var(--space-1);">{{ $umkm->nama_umkm }}</h1>

                <table class="detail-meta-table">
                    <tbody>
                        <tr class="detail-meta-row">
                            <td class="detail-meta-label">Pemilik</td>
                            <td class="detail-meta-value">{{ $umkm->nama_pemilik }}</td>
                        </tr>
                        <tr class="detail-meta-row">
                            <td class="detail-meta-label">Jenis Usaha</td>
                            <td class="detail-meta-value">{{ $umkm->jenis_usaha }}</td>
                        </tr>
                        @if($umkm->jam_operasional)
                            <tr class="detail-meta-row">
                                <td class="detail-meta-label">Jam Operasional</td>
                                <td class="detail-meta-value">{{ $umkm->jam_operasional }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {{-- Produk tags --}}
                @if($umkm->produkUmkms->isNotEmpty())
                    <div>
                        <p class="form-label" style="margin-bottom:var(--space-1);">Produk</p>
                        <ul class="produk-tag-list">
                            @foreach($umkm->produkUmkms as $p)
                                <li class="produk-tag">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                                    {{ $p->nama_produk }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- WhatsApp CTA --}}
                <x-partials.whatsapp-btn :nomor="$umkm->nomor_whatsapp" label="Hubungi via WhatsApp" class="w-full" style="margin-top:var(--space-1);" />
            </div>
        </div>

        {{-- Description --}}
        @if($umkm->deskripsi)
            <div class="resource-row mt-3" style="flex-direction:column;gap:var(--space-2);">
                <div style="display:flex;gap:var(--space-2);align-items:center;">
                    <span style="color:var(--color-moss);" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </span>
                    <strong class="info-value">Deskripsi</strong>
                </div>
                <p style="font-size:0.9375rem;color:var(--color-dark-olive);line-height:1.7;">{{ $umkm->deskripsi }}</p>
            </div>
        @endif

        {{-- Address --}}
        @if($umkm->alamat)
            <div class="resource-row mt-2" style="justify-content:space-between;align-items:center;">
                <div style="display:flex;gap:var(--space-2);align-items:flex-start;">
                    <span style="color:var(--color-moss);margin-top:2px;" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div>
                        <p class="info-label">Alamat</p>
                        <p class="info-value">{{ $umkm->alamat }}</p>
                    </div>
                </div>
                @if($umkm->latitude !== null && $umkm->longitude !== null)
                    <a
                        href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($umkm->latitude . ',' . $umkm->longitude) }}"
                        class="btn-link"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Lihat lokasi {{ $umkm->nama_umkm }} di peta"
                    >
                        Lihat Lokasi →
                    </a>
                @endif
            </div>
        @endif

    </div>
</div>

@endsection
