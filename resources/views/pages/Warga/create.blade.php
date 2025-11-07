@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Data Warga</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('warga.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">No KTP *</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                            id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" maxlength="16" required>
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                            id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="agama" class="form-label">Agama *</label>
                        <input type="text" class="form-control @error('agama') is-invalid @enderror" 
                            id="agama" name="agama" value="{{ old('agama') }}" required>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan *</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                            id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telp" class="form-label">Telepon *</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                            id="telp" name="telp" value="{{ old('telp') }}" required>
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection