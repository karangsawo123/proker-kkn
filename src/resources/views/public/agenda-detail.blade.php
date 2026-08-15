@extends('layouts.public')

@section('title', $agenda->judul . ' — Agenda — Portal Informasi')
@push('meta')
    <meta name="description" content="Agenda: {{ $agenda->judul }}. {{ $effectiveStatus }}.{{ $agenda->lokasi_text ? ' Lokasi: ' . $agenda->lokasi_text . '.' : '' }}">
@endpush

@section('content')

<div class="section-public">
    <div class="container-narrow">

        {{-- Back link --}}
        @if($agenda->scope_level === 'DUSUN' && $agenda->dusun)
            <a href="{{ route('dusun.show', $agenda->dusun_id) }}#agenda" class="back-link mb-3" style="display:inline-flex;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Agenda &amp; Kegiatan
            </a>
        @else
            <a href="{{ route('home') }}#agenda" class="back-link mb-3" style="display:inline-flex;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Agenda &amp; Kegiatan
            </a>
        @endif

        {{-- Header --}}
        <div class="detail-header">
            <div style="display:flex;align-items:flex-start;gap:var(--space-2);flex-wrap:wrap;margin-bottom:var(--space-2);">
                <h1 class="detail-title" style="margin-bottom:0;">{{ $agenda->judul }}</h1>
                <x-partials.status-badge :status="$effectiveStatus" />
            </div>
        </div>

        <div class="detail-grid" style="gap:var(--space-4);">

            {{-- Left: Poster --}}
            @php
                $poster = $agenda->agendaMedias->where('media_role', 'POSTER_AWAL')->first();
            @endphp
            <div>
                <p class="info-label" style="margin-bottom:var(--space-1);">Poster</p>
                @if($poster)
                    <img
                        src="{{ asset('storage/' . $poster->media_path) }}"
                        alt="Poster {{ $agenda->judul }}"
                        class="media-img"
                        loading="lazy"
                    >
                @else
                    <x-partials.media-placeholder />
                @endif
            </div>

            {{-- Right: Meta info --}}
            <div style="display:flex;flex-direction:column;gap:var(--space-2);">
                <div class="info-block">
                    <div class="info-row">
                        <span class="info-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </span>
                        <div>
                            <p class="info-label">Tanggal</p>
                            <p class="info-value">
                                {{ \Illuminate\Support\Carbon::parse($agenda->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY') }}
                                @if($agenda->tanggal_selesai && $agenda->tanggal_selesai->ne($agenda->tanggal_mulai))
                                    — {{ \Illuminate\Support\Carbon::parse($agenda->tanggal_selesai)->locale('id')->isoFormat('D MMMM YYYY') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($agenda->jam)
                        <div class="info-row">
                            <span class="info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </span>
                            <div>
                                <p class="info-label">Jam</p>
                                <p class="info-value">{{ $agenda->jam }}</p>
                            </div>
                        </div>
                    @endif

                    @if($agenda->lokasi_text)
                        <div class="info-row">
                            <span class="info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <div>
                                <p class="info-label">Lokasi</p>
                                <p class="info-value">{{ $agenda->lokasi_text }}</p>
                            </div>
                        </div>
                    @endif

                    @if($agenda->deskripsi_singkat)
                        <div class="info-row">
                            <span class="info-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </span>
                            <div>
                                <p class="info-label">Deskripsi</p>
                                <p class="info-value" style="line-height:1.7;">{{ $agenda->deskripsi_singkat }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Dokumentasi media --}}
        @php
            $dokumentasi = $agenda->agendaMedias->where('media_role', 'DOKUMENTASI');
        @endphp
        @if($dokumentasi->isNotEmpty())
            <div class="mt-4">
                <h2 style="font-size:1.125rem;font-family:var(--font-heading);color:var(--color-dark-olive);margin-bottom:var(--space-2);">
                    Dokumentasi
                </h2>
                <div class="card-grid-sm">
                    @foreach($dokumentasi as $media)
                        <figure style="margin:0;">
                            <img
                                src="{{ asset('storage/' . $media->media_path) }}"
                                alt="Dokumentasi {{ $agenda->judul }}"
                                class="media-img"
                                loading="lazy"
                            >
                        </figure>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
