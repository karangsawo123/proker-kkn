@extends('layouts.public')

@section('title', $pengumuman->judul . ' — Pengumuman — Portal Informasi')
@push('meta')
    <meta name="description" content="Pengumuman: {{ $pengumuman->judul }}. Konteks: {{ $pengumuman->scope_level === 'DUSUN' ? ($pengumuman->dusun?->nama_dusun ?? 'Dusun') : 'Desa' }}.">
@endpush

@section('content')

<div class="section-public">
    <div class="container-narrow">

        {{-- Back link --}}
        @if($pengumuman->scope_level === 'DUSUN' && $pengumuman->dusun)
            <a href="{{ route('dusun.show', $pengumuman->dusun_id) }}#pengumuman" class="back-link mb-3" style="display:inline-flex;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Pengumuman
            </a>
        @else
            <a href="{{ route('home') }}#pengumuman" class="back-link mb-3" style="display:inline-flex;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali ke Pengumuman
            </a>
        @endif

        {{-- Header --}}
        <div class="detail-header">
            <div style="display:flex;align-items:flex-start;gap:var(--space-2);flex-wrap:wrap;margin-bottom:var(--space-2);">
                <h1 class="detail-title" style="margin-bottom:0;">{{ $pengumuman->judul }}</h1>
                @if($isArchived)
                    <span class="badge badge-arsip">Arsip</span>
                @else
                    <span class="badge badge-aktif">Aktif</span>
                @endif
            </div>

            <div style="display:flex;flex-wrap:wrap;gap:var(--space-3);">
                <div>
                    <p class="info-label">Konteks</p>
                    <p class="info-value">
                        @if($pengumuman->scope_level === 'DUSUN')
                            Dusun {{ $pengumuman->dusun?->nama_dusun ?? '—' }}
                        @else
                            Desa
                        @endif
                    </p>
                </div>
                <div>
                    <p class="info-label">Tanggal</p>
                    <p class="info-value">
                        @if($isArchived)
                            Berakhir {{ \Illuminate\Support\Carbon::parse($pengumuman->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMMM YYYY') }}
                        @else
                            Berlaku hingga {{ \Illuminate\Support\Carbon::parse($pengumuman->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMMM YYYY') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <hr style="border:none;border-top:1px solid var(--color-warm-beige);margin-block:var(--space-3);">

        {{-- Content --}}
        <div>
            <h2 style="font-size:1.25rem;font-family:var(--font-heading);color:var(--color-dark-olive);margin-bottom:var(--space-2);">
                Isi Pengumuman
            </h2>
            <div class="detail-content" style="max-width:100%;">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>
        </div>

    </div>
</div>

@endsection
