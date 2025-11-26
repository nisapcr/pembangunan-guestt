@extends('layouts.guest.app')
@section('title', 'Edit Data Warga')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i>Edit Data Warga
                </h5>
                <a href="{{ route('warga.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- ALERT / NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-2" role="alert">
            <i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Edit Warga -->
    <div class="card shadow-sm mx-2">
        <div class="card-body">
            <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_ktp" class="form-label">No. KTP</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}"
                               maxlength="16" required>
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" value="{{ old('nama', $warga->nama) }}"
                               maxlength="100" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <select class="form-control @error('agama') is-invalid @enderror"
                                id="agama" name="agama">
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                               maxlength="50">
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror"
                               id="telp" name="telp" value="{{ old('telp', $warga->telp) }}"
                               maxlength="15">
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $warga->email) }}"
                               maxlength="255">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.container-fluid {
    padding-left: 20px;
    padding-right: 20px;
}

.card {
    border-radius: 10px;
    margin: 5px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.form-control:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.btn {
    border-radius: 5px;
}

@media (max-width: 768px) {
    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }

    .mx-2 {
        margin-left: 10px !important;
        margin-right: 10px !important;
    }
}
</style>
@endsection
