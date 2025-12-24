@extends('layouts.guest.app')
@section('title', 'Tambah Tahapan Proyek')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Tahapan Proyek
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tahapan.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- PROYEK --}}
                        <div class="mb-3">
                            <label class="form-label">Proyek <span class="text-danger">*</span></label>
                            <select name="proyek_id" class="form-control @error('proyek_id') is-invalid @enderror">
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($proyeks as $proyek)
                                    <option value="{{ $proyek->proyek_id }}"
                                        {{ old('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                        {{ $proyek->nama_proyek }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proyek_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- NAMA TAHAPAN --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Tahapan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_tahapan"
                                    class="form-control @error('nama_tahapan') is-invalid @enderror"
                                    value="{{ old('nama_tahapan') }}" required>
                                @error('nama_tahapan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TARGET --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Target Progress (%) <span class="text-danger">*</span></label>
                                <input type="number" name="target_persen"
                                    class="form-control @error('target_persen') is-invalid @enderror"
                                    value="{{ old('target_persen') }}" min="0" max="100" required>
                                @error('target_persen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- TANGGAL MULAI --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_mulai"
                                    class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                    value="{{ old('tanggal_mulai') }}" required>
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TANGGAL SELESAI --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_selesai"
                                    class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                    value="{{ old('tanggal_selesai') }}" required>
                                @error('tanggal_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Tahapan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
