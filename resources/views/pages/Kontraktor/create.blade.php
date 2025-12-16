@extends('layouts.guest.app')
@section('title', 'Tambah Kontraktor Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-hard-hat me-2"></i>Tambah Kontraktor Baru
                    </h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('kontraktor.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="proyek_id" class="form-label">Proyek <span class="text-danger">*</span></label>
                                <select name="proyek_id" id="proyek_id" class="form-control @error('proyek_id') is-invalid @enderror" required>
                                    <option value="">Pilih Proyek</option>
                                    @foreach($proyeks as $proyek)
                                        <option value="{{ $proyek->proyek_id }}" {{ old('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                            {{ $proyek->nama_proyek }} ({{ $proyek->kode_proyek }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('proyek_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Kontraktor <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                       value="{{ old('nama') }}" required maxlength="100">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                                <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                       value="{{ old('penanggung_jawab') }}" required maxlength="100">
                                @error('penanggung_jawab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                <input type="text" name="kontak" id="kontak" class="form-control @error('kontak') is-invalid @enderror"
                                       value="{{ old('kontak') }}" required maxlength="20" placeholder="Contoh: +6281234567890">
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: +62 atau 08 diikuti nomor telepon</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"
                                          required maxlength="500">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Kontraktor
                            </button>
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
.form-label {
    font-weight: 500;
    color: #495057;
}
</style>
@endsection
