@extends('layouts.guest.app')
@section('title', 'Edit Lokasi Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Tambah Lokasi Proyek
                    </h5>
                </div>

                <div class="card-body"><!-- resources/views/pages/lokasi/create.blade.php -->
<form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data" id="form-lokasi">
    @csrf

    <!-- Proyek -->
    <div class="mb-3">
        <label class="form-label">Proyek</label>
        <select name="proyek_id" class="form-select" required>
            <option value="">Pilih Proyek</option>
            @foreach($proyeks as $proyek)
                <option value="{{ $proyek->proyek_id }}" {{ old('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                    {{ $proyek->nama_proyek }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Nama Lokasi -->
    <div class="mb-3">
        <label class="form-label">Nama Lokasi *</label>
        <input type="text" name="nama_lokasi" class="form-control" value="{{ old('nama_lokasi') }}" required>
    </div>

    <!-- Alamat -->
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
    </div>

    <!-- Koordinat -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Latitude</label>
            <input type="number" step="any" name="lat" class="form-control" value="{{ old('lat') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Longitude</label>
            <input type="number" step="any" name="lng" class="form-control" value="{{ old('lng') }}">
        </div>
    </div>

    <!-- Denah Gambar -->
    <div class="mb-3">
        <label class="form-label">Denah Gambar (Max 2MB)</label>
        <input type="file" name="denah_gambar" class="form-control"
               accept="image/jpeg,image/png,image/jpg,image/gif,image/svg,image/webp,image/bmp">
        <small class="text-muted">Format: JPEG, PNG, JPG, GIF, SVG, WebP, BMP</small>
    </div>

    <!-- Media Tambahan -->
    <div class="mb-3">
        <label class="form-label">Media Tambahan (Max 5MB per file, maks 10 file)</label>
        <input type="file" name="media_tambahan[]" class="form-control" multiple
               accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
        <small class="text-muted">Format: Gambar, PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT</small>
    </div>

    <!-- GeoJSON -->
    <div class="mb-3">
        <label class="form-label">GeoJSON (Optional)</label>
        <textarea name="geojson" class="form-control" rows="3" placeholder='{"type": "Feature", ...}'>{{ old('geojson') }}</textarea>
    </div>

    <!-- Progress Bar untuk Upload -->
    <div id="upload-progress" class="d-none mb-3">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated"
                 role="progressbar" style="width: 0%"></div>
        </div>
        <small id="progress-text" class="text-muted"></small>
    </div>

    <!-- Error Messages -->
    <div id="form-errors" class="alert alert-danger d-none"></div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary" id="submit-btn">
            <span class="spinner-border spinner-border-sm d-none" id="loading-spinner"></span>
            Simpan Lokasi
        </button>
    </div>
</form>
