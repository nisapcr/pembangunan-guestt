{{-- resources/views/proyek/create.blade.php --}}
@extends('layouts.guest.app')
@section('title', 'Tambah Proyek Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Proyek Baru
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kode_proyek" class="form-label">Kode Proyek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_proyek') is-invalid @enderror"
                                       id="kode_proyek" name="kode_proyek"
                                       value="{{ old('kode_proyek') }}" required>
                                @error('kode_proyek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_proyek" class="form-label">Nama Proyek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_proyek') is-invalid @enderror"
                                       id="nama_proyek" name="nama_proyek"
                                       value="{{ old('nama_proyek') }}" required>
                                @error('nama_proyek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                                <select class="form-control @error('tahun') is-invalid @enderror"
                                        id="tahun" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @for($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                       id="lokasi" name="lokasi"
                                       value="{{ old('lokasi') }}" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="anggaran" class="form-label">Anggaran (Rp) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('anggaran') is-invalid @enderror"
                                       id="anggaran" name="anggaran"
                                       value="{{ old('anggaran') }}" required>
                                @error('anggaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sumber_dana" class="form-label">Sumber Dana <span class="text-danger">*</span></label>
                                <select class="form-control @error('sumber_dana') is-invalid @enderror"
                                        id="sumber_dana" name="sumber_dana" required>
                                    <option value="">Pilih Sumber Dana</option>
                                    <option value="APBD" {{ old('sumber_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                                    <option value="APBN" {{ old('sumber_dana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                                    <option value="Swadaya" {{ old('sumber_dana') == 'Swadaya' ? 'selected' : '' }}>Swadaya</option>
                                    <option value="Swasta" {{ old('sumber_dana') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                    <option value="Hibah" {{ old('sumber_dana') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                </select>
                                @error('sumber_dana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Proyek</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dokumen" class="form-label">Dokumen Proyek</label>
                            <input type="file" class="form-control @error('dokumen') is-invalid @enderror"
                                   id="dokumen" name="dokumen"
                                   accept=".pdf,.doc,.docx,.jpg,.png">
                            <small class="form-text text-muted">
                                Format: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)
                            </small>
                            @error('dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Proyek
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
