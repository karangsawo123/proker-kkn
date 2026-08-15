@extends('layouts.public')

@section('title', 'Arsip Pengumuman — ' . $contextLabel . ' — Portal Informasi')
@push('meta')
    <meta name="description" content="Arsip pengumuman yang telah melewati masa aktif pada konteks {{ $contextLabel }}. Dapat dibaca oleh publik.">
@endpush

@section('content')

<div class="section-public container-narrow" style="max-width:56rem;">

    {{-- Back link --}}
    <a href="{{ $backUrl }}" class="back-link mb-3" style="display:inline-flex;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Pengumuman
    </a>

    {{-- Page title --}}
    <div style="margin-bottom:var(--space-3);">
        <h1 class="hero-title" style="color:var(--color-dark-olive);font-size:clamp(1.75rem,4vw,2.5rem);">
            Arsip Pengumuman
        </h1>
        <p class="text-sage" style="margin-top:var(--space-1);">Konteks: {{ $contextLabel }}</p>
        <p style="color:var(--color-sage);font-size:0.9375rem;margin-top:4px;">
            Pengumuman yang telah melewati masa aktif tetap dapat dibaca di sini.
        </p>
    </div>

    {{-- Archive list --}}
    @if($pengumumans->isEmpty())
        <x-partials.empty-state label="Belum ada pengumuman yang sudah berakhir masa aktifnya." />
    @else
        <div class="card-grid-sm">
            @foreach($pengumumans as $p)
                <article class="card" id="arsip-pengumuman-{{ $p->id }}">
                    <div class="card-body">
                        <div style="display:flex;align-items:flex-start;gap:var(--space-2);">
                            <div style="flex-shrink:0;background:var(--color-warm-beige);border-radius:var(--radius-2);width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:var(--color-moss);" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div style="display:flex;align-items:center;gap:var(--space-1);flex-wrap:wrap;margin-bottom:4px;">
                                    <h2 class="card-title" style="font-size:0.9375rem;">{{ $p->judul }}</h2>
                                    <span class="badge badge-arsip" style="display:inline-flex;align-items:center;gap:4px;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        Arsip
                                    </span>
                                </div>
                                @if($p->isi)
                                    <p class="card-meta" style="line-clamp:2;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                                        {{ Str::limit(strip_tags($p->isi), 100) }}
                                    </p>
                                @endif
                                <p class="card-meta" style="margin-top:4px;">
                                    Berakhir: {{ \Illuminate\Support\Carbon::parse($p->tanggal_kedaluwarsa)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="justify-content:flex-start;">
                        <a href="{{ route('pengumuman.show', $p->id) }}" class="btn-link">
                            Baca Pengumuman →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($pengumumans->hasPages())
            <div class="pagination-wrap">
                {{ $pengumumans->links('partials.pagination') }}
            </div>
        @endif
    @endif

</div>

@endsection
