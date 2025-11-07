{{-- resources/views/pages/proyek/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Proyek: {{ $proyek->nama_proyek }}
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Alert untuk menampilkan pesan error/success --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('proyek.update', $proyek->proyek_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kode_proyek" class="form-label">Kode Proyek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_proyek') is-invalid @enderror" 
                                       id="kode_proyek" name="kode_proyek" 
                                       value="{{ old('kode_proyek', $proyek->kode_proyek) }}" 
                                       placeholder="Masukkan kode proyek" required>
                                @error('kode_proyek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama_proyek" class="form-label">Nama Proyek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_proyek') is-invalid @enderror" 
                                       id="nama_proyek" name="nama_proyek" 
                                       value="{{ old('nama_proyek', $proyek->nama_proyek) }}" 
                                       placeholder="Masukkan nama proyek" required>
                                @error('nama_proyek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                                <select class="form-select @error('tahun') is-invalid @enderror" 
                                        id="tahun" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @for($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}" 
                                            {{ old('tahun', $proyek->tahun) == $year ? 'selected' : '' }}>
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
                                       value="{{ old('lokasi', $proyek->lokasi) }}" 
                                       placeholder="Masukkan lokasi proyek" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="anggaran" class="form-label">Anggaran (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" step="0.01" class="form-control @error('anggaran') is-invalid @enderror" 
                                           id="anggaran" name="anggaran" 
                                           value="{{ old('anggaran', $proyek->anggaran) }}" 
                                           placeholder="0.00" required>
                                </div>
                                @error('anggaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sumber_dana" class="form-label">Sumber Dana <span class="text-danger">*</span></label>
                                <select class="form-select @error('sumber_dana') is-invalid @enderror" 
                                        id="sumber_dana" name="sumber_dana" required>
                                    <option value="">Pilih Sumber Dana</option>
                                    <option value="APBD" {{ old('sumber_dana', $proyek->sumber_dana) == 'APBD' ? 'selected' : '' }}>APBD</option>
                                    <option value="APBN" {{ old('sumber_dana', $proyek->sumber_dana) == 'APBN' ? 'selected' : '' }}>APBN</option>
                                    <option value="Swadaya" {{ old('sumber_dana', $proyek->sumber_dana) == 'Swadaya' ? 'selected' : '' }}>Swadaya</option>
                                    <option value="Swasta" {{ old('sumber_dana', $proyek->sumber_dana) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                    <option value="Hibah" {{ old('sumber_dana', $proyek->sumber_dana) == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                    <option value="Lainnya" {{ old('sumber_dana', $proyek->sumber_dana) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('sumber_dana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Proyek</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" 
                                      rows="4" 
                                      placeholder="Masukkan deskripsi proyek (opsional)">{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dokumen" class="form-label">Dokumen Proyek</label>
                            
                            {{-- Tampilkan dokumen saat ini jika ada --}}
                            @if($proyek->dokumen)
                                <div class="alert alert-info py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                            <span class="fw-medium">Dokumen saat ini:</span>
                                            <a href="{{ Storage::url($proyek->dokumen) }}" 
                                               target="_blank" 
                                               class="text-primary ms-2">
                                                {{ basename($proyek->dokumen) }}
                                            </a>
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Upload file baru untuk mengganti
                                        </small>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning py-2">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Tidak ada dokumen yang diupload
                                </div>
                            @endif
                            
                            <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                                   id="dokumen" name="dokumen" 
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format file: PDF, DOC, DOCX, JPG, PNG (Maksimal: 2MB)
                            </div>
                            @error('dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar
                            </a>
                            <div>
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="fas fa-undo me-1"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="fas fa-save me-1"></i>Update Proyek
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    font-weight: 600;
}

.form-control:focus, .form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #212529;
    font-weight: 500;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #e0a800;
    color: #212529;
}
</style>
@endsection