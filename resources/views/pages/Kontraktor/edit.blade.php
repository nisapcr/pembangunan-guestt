@extends('layouts.guest.app')
@section('title', 'Edit Kontraktor')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Kontraktor
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('kontraktor.update', $kontraktor->kontraktor_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Proyek -->
                        <div class="mb-3">
                            <label class="form-label">Proyek <span class="text-danger">*</span></label>
                            <select name="proyek_id" class="form-control @error('proyek_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($proyeks as $proyek)
                                    <option value="{{ $proyek->proyek_id }}"
                                        {{ old('proyek_id', $kontraktor->proyek_id) == $proyek->proyek_id ? 'selected' : '' }}>
                                        {{ $proyek->nama_proyek }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proyek_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Kontraktor -->
                        <div class="mb-3">
                            <label class="form-label">Nama Kontraktor <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $kontraktor->nama) }}"
                                   placeholder="Contoh: PT. Bangun Jaya Abadi" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Penanggung Jawab -->
                        <div class="mb-3">
                            <label class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" name="penanggung_jawab"
                                   class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                   value="{{ old('penanggung_jawab', $kontraktor->penanggung_jawab) }}"
                                   placeholder="Contoh: Budi Santoso" required>
                            @error('penanggung_jawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kontak -->
                        <div class="mb-3">
                            <label class="form-label">Kontak <span class="text-danger">*</span></label>
                            <input type="text" name="kontak"
                                   class="form-control @error('kontak') is-invalid @enderror"
                                   value="{{ old('kontak', $kontraktor->kontak) }}"
                                   placeholder="Contoh: +6281234567890 atau 081234567890" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: +62 atau 08</small>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      placeholder="Alamat lengkap kontraktor..." required>{{ old('alamat', $kontraktor->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <div>
                                <a href="{{ route('kontraktor.show', $kontraktor->kontraktor_id) }}"
                                   class="btn btn-info me-2">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Kontraktor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format kontak saat input
    const kontakInput = document.querySelector('input[name="kontak"]');

    kontakInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^\d+]/g, '');

        // Auto add +62 if starts with 0
        if (value.startsWith('0') && !value.startsWith('+62')) {
            value = '+62' + value.substring(1);
        }

        e.target.value = value;
    });
});
</script>
@endsection
