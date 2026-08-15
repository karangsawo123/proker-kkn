@extends('layouts.super-admin')

@section('title', 'Kelola Kontak Pelayanan')
@section('breadcrumb')
    <a href="{{ route('super-admin.dashboard') }}">Dashboard</a> / <span>Kontak Pelayanan</span>
@endsection

@section('content')
<div class="admin-page-header flex-between">
    <div>
        <h1 class="admin-page-title">Kontak Pelayanan (Global)</h1>
        <p class="admin-page-desc">Kelola seluruh kontak pelayanan dan perangkat desa/dusun di Desa Bendung.</p>
    </div>
    <div>
        <a href="{{ route('super-admin.kontak.create') }}" class="btn btn-primary">
            + Tambah Kontak Baru
        </a>
    </div>
</div>

<!-- Filters Bar -->
<div class="admin-card mb-3">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="GET" action="{{ route('super-admin.kontak.index') }}" class="filter-form-bar">
            <div class="filter-group">
                <label for="status" class="filter-label">Status Data:</label>
                <select name="status" id="status" class="form-select filter-select" onchange="this.form.submit()">
                    <option value="active" {{ $statusFilter === 'active' ? 'selected' : '' }}>Aktif (Non-Deleted)</option>
                    <option value="trashed" {{ $statusFilter === 'trashed' ? 'selected' : '' }}>Soft Deleted (Nonaktif)</option>
                    <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>Semua Data</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="dusun_id" class="filter-label">Filter Dusun:</label>
                <select name="dusun_id" id="dusun_id" class="form-select filter-select" onchange="this.form.submit()">
                    <option value="">-- Seluruh Dusun --</option>
                    @foreach($dusuns as $dusun)
                        <option value="{{ $dusun->id }}" {{ (string)$dusunFilter === (string)$dusun->id ? 'selected' : '' }}>
                            {{ $dusun->nama_dusun }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if(!empty($dusunFilter) || $statusFilter !== 'active')
                <a href="{{ route('super-admin.kontak.index') }}" class="btn btn-sm btn-secondary">Reset Filter</a>
            @endif
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body p-0">
        @if($kontakList->isEmpty())
            <div class="admin-empty-state">
                <div class="empty-icon">📞</div>
                <h3 class="empty-title">Belum ada data kontak</h3>
                <p class="empty-desc">Tidak ada data kontak pelayanan yang sesuai dengan kriteria filter saat ini.</p>
                <a href="{{ route('super-admin.kontak.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    + Tambah Kontak Pertama
                </a>
            </div>
        @else
            <div class="admin-table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama & Jabatan</th>
                            <th>Wilayah Dusun</th>
                            <th>Nomor WhatsApp</th>
                            <th>Status Rekod</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kontakList as $kontak)
                            <tr class="{{ $kontak->trashed() ? 'row-trashed' : '' }}">
                                <td class="table-thumb-col">
                                    @if($kontak->foto_path)
                                        <img src="{{ asset('storage/' . $kontak->foto_path) }}" alt="{{ $kontak->nama }}" class="table-thumb">
                                    @else
                                        <div class="table-thumb-placeholder">👤</div>
                                    @endif
                                </td>
                                <td>
                                    <strong class="item-title">{{ $kontak->nama }}</strong>
                                    <div class="item-subtitle">{{ $kontak->jabatan }}</div>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $kontak->dusun->nama_dusun ?? 'Dusun' }}</span>
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $kontak->nomor_whatsapp)) }}" target="_blank" class="wa-link">
                                        {{ $kontak->nomor_whatsapp }}
                                    </a>
                                </td>
                                <td>
                                    @if($kontak->trashed())
                                        <span class="badge badge-danger">🗑️ Soft Deleted</span>
                                    @else
                                        <span class="badge badge-success">✓ Aktif</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="action-buttons">
                                        @if($kontak->trashed())
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-primary"
                                                onclick="openRestoreModal('{{ route('super-admin.kontak.restore', $kontak->id) }}', '{{ addslashes($kontak->nama) }}')"
                                            >
                                                Pulihkan
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger"
                                                onclick="openForceDeleteModal('{{ route('super-admin.kontak.force-delete', $kontak->id) }}', '{{ addslashes($kontak->nama) }}')"
                                            >
                                                Hapus Permanen
                                            </button>
                                        @else
                                            <a href="{{ route('super-admin.kontak.edit', $kontak->id) }}" class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="openDeactivateModal('{{ route('super-admin.kontak.destroy', $kontak->id) }}', '{{ addslashes($kontak->nama) }}')"
                                            >
                                                Nonaktifkan
                                            </button>
                                        @endif
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
