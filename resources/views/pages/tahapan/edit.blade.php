@extends('layouts.guest.app')
@section('title', 'Edit Tahapan Proyek')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4 fw-bold">Edit Tahapan Proyek</h3>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- PROYEK --}}
                <div class="mb-3">
                    <label class="form-label">Proyek <span class="text-danger">*</span></label>
                    <select name="proyek_id"
                            class="form-control @error('proyek_id') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Proyek --</option>

                        @foreach ($proyeks as $p)
                            <option value="{{ $p->proyek_id }}"
                                {{ old('proyek_id', $tahapan->proyek_id) == $p->proyek_id ? 'selected' : '' }}>
                                {{ $p->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                    @error('proyek_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NAMA TAHAPAN --}}
                <div class="mb-3">
                    <label class="form-label">Nama Tahapan <span class="text-danger">*</span></label>
                    <input type="text"
                           name="nama_tahapan"
                           class="form-control @error('nama_tahapan') is-invalid @enderror"
                           value="{{ old('nama_tahapan', $tahapan->nama_tahapan) }}"
                           required>
                    @error('nama_tahapan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}


                {{-- TARGET PROGRES --}}
                <div class="mb-3">
                    <label class="form-label">Target Progres (%) <span class="text-danger">*</span></label>
                    <input type="number"
                           name="target_persen"
                           class="form-control @error('target_persen') is-invalid @enderror"
                           value="{{ old('target_persen', $tahapan->target_persen) }}"
                           min="0" max="100"
                           required>
                    @error('target_persen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control @error('tanggal_mulai') is-invalid @enderror"
                               value="{{ old('tanggal_mulai', $tahapan->tanggal_mulai ? $tahapan->tanggal_mulai->format('Y-m-d') : '') }}"
                               required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control @error('tanggal_selesai') is-invalid @enderror"
                               value="{{ old('tanggal_selesai', $tahapan->tanggal_selesai ? $tahapan->tanggal_selesai->format('Y-m-d') : '') }}"
                               required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status"
                            class="form-control @error('status') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Status --</option>
                        <option value="pending"     {{ old('status', $tahapan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $tahapan->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed"   {{ old('status', $tahapan->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
