@extends('layouts.super-admin')

@section('title', 'Edit Profil Dusun')
@section('breadcrumb')
    <a href="{{ route('super-admin.dashboard') }}">Dashboard</a> /
    <a href="{{ route('super-admin.dusun.index') }}">Kelola Dusun</a> /
    <span>Edit: {{ $dusun->nama_dusun }}</span>
@endsection

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Edit Profil {{ $dusun->nama_dusun }}</h1>
    <p class="admin-page-desc">Perbarui data profil, pimpinan wilayah, dan banner dusun.</p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Formulir Profil Dusun</h2>
        <span class="badge {{ $dusun->status_dusun === 'ACTIVE' ? 'badge-success' : 'badge-danger' }}">
            Status: {{ $dusun->status_dusun === 'ACTIVE' ? 'AKTIF PUBLIK' : 'NONAKTIF' }}
        </span>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="{{ route('super-admin.dusun.update', $dusun->id) }}" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="nama_dusun" class="form-label">
                        Nama Dusun <span class="required-mark">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama_dusun"
                        id="nama_dusun"
                        class="form-input @error('nama_dusun') is-invalid @enderror"
                        value="{{ old('nama_dusun', $dusun->nama_dusun) }}"
                        required
                        maxlength="150"
                    >
                    @error('nama_dusun')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_kepala_dusun" class="form-label">
                        Nama Kepala Dusun (Kamituwo / Kadus) <span class="required-mark">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama_kepala_dusun"
                        id="nama_kepala_dusun"
                        class="form-input @error('nama_kepala_dusun') is-invalid @enderror"
                        value="{{ old('nama_kepala_dusun', $dusun->nama_kepala_dusun) }}"
                        required
                        maxlength="150"
                    >
                    @error('nama_kepala_dusun')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jumlah_rt" class="form-label">
                        Jumlah RT <span class="required-mark">*</span>
                    </label>
                    <input
                        type="number"
                        name="jumlah_rt"
                        id="jumlah_rt"
                        min="0"
                        class="form-input @error('jumlah_rt') is-invalid @enderror"
                        value="{{ old('jumlah_rt', $dusun->jumlah_rt) }}"
                        required
                    >
                    @error('jumlah_rt')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah_rw" class="form-label">
                        Jumlah RW <span class="required-mark">*</span>
                    </label>
                    <input
                        type="number"
                        name="jumlah_rw"
                        id="jumlah_rw"
                        min="0"
                        class="form-input @error('jumlah_rw') is-invalid @enderror"
                        value="{{ old('jumlah_rw', $dusun->jumlah_rw) }}"
                        required
                    >
                    @error('jumlah_rw')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi_singkat" class="form-label">
                    Deskripsi / Profil Singkat Dusun <span class="required-mark">*</span>
                </label>
                <textarea
                    name="deskripsi_singkat"
                    id="deskripsi_singkat"
                    rows="4"
                    class="form-textarea @error('deskripsi_singkat') is-invalid @enderror"
                    required
                >{{ old('deskripsi_singkat', $dusun->deskripsi_singkat) }}</textarea>
                @error('deskripsi_singkat')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="banner" class="form-label">
                    Foto Banner Dusun <span class="optional-tag">(Opsional, Maks. 3MB, Format JPG/PNG/WebP)</span>
                </label>
                @if($dusun->banner_path)
                    <div class="current-media-preview">
                        <img src="{{ asset('storage/' . $dusun->banner_path) }}" alt="Banner {{ $dusun->nama_dusun }}" class="preview-img">
                        <span class="preview-text">Banner tersimpan. Unggah berkas baru jika ingin mengganti.</span>
                    </div>
                @endif
                <input
                    type="file"
                    name="banner"
                    id="banner"
                    accept="image/jpeg,image/png,image/webp"
                    class="form-file @error('banner') is-invalid @enderror"
                >
                @error('banner')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('super-admin.dusun.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Profil Dusun</button>
            </div>
        </form>
    </div>
</div>
@endsection
