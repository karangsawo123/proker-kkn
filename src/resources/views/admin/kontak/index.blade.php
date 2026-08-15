@extends('layouts.admin')

@section('title', 'Kelola Kontak Pelayanan')
@section('breadcrumb')
    <a href="{{ route('admin-dusun.dashboard') }}">Dashboard</a> / <span>Kontak Pelayanan</span>
@endsection

@section('content')
<div class="admin-page-header flex-between">
    <div>
        <h1 class="admin-page-title">Kontak Pelayanan Dusun</h1>
        <p class="admin-page-desc">Kelola daftar nomor kontak perangkat dan layanan masyarakat di wilayah {{ $dusun->nama_dusun }}.</p>
    </div>
    <div>
        <a href="{{ route('admin-dusun.kontak.create') }}" class="btn btn-primary">
            + Tambah Kontak
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body p-0">
        @if($kontakList->isEmpty())
            <div class="admin-empty-state">
                <div class="empty-icon">☎️</div>
                <h3 class="empty-title">Belum ada kontak pelayanan</h3>
                <p class="empty-desc">Tambahkan kontak perangkat atau petugas pelayanan masyarakat di dusun ini.</p>
                <a href="{{ route('admin-dusun.kontak.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    + Tambah Kontak Pertama
                </a>
            </div>
        @else
            <div class="admin-table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Petugas</th>
                            <th>Jabatan / Peran</th>
                            <th>WhatsApp</th>
                            <th>Lokasi / Alamat</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kontakList as $kontak)
                            <tr>
                                <td class="table-thumb-col">
                                    @if($kontak->foto_path)
                                        <img src="{{ asset('storage/' . $kontak->foto_path) }}" alt="{{ $kontak->nama }}" class="table-thumb">
                                    @else
                                        <div class="table-thumb-placeholder">👤</div>
                                    @endif
                                </td>
                                <td>
                                    <strong class="item-title">{{ $kontak->nama }}</strong>
                                </td>
                                <td>{{ $kontak->jabatan }}</td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->nomor_whatsapp) }}" target="_blank" rel="noopener" class="wa-link">
                                        💬 {{ $kontak->nomor_whatsapp }}
                                    </a>
                                </td>
                                <td>
                                    {{ $kontak->alamat_pelayanan ?? '—' }}
                                    @if($kontak->latitude && $kontak->longitude)
                                        <span class="coord-badge" title="Koordinat tersedia">📍 Ada Titik Peta</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin-dusun.kontak.edit', $kontak->id) }}" class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="openDeactivateModal('{{ route('admin-dusun.kontak.destroy', $kontak->id) }}', '{{ addslashes($kontak->nama) }}')"
                                        >
                                            Nonaktifkan
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="admin-pagination-wrapper">
                {{ $kontakList->links('partials.pagination') }}
            </div>
        @endif
    </div>
</div>
@endsection
