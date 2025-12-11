@extends('layouts.guest.app')
@section('title', 'Tambah Progress Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Progress Proyek
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('progres.store') }}" method="POST" enctype="multipart/form-data">
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

                        <!-- Proyek -->
                        <div class="mb-3">
                            <label class="form-label">Proyek <span class="text-danger">*</span></label>
                            <select name="proyek_id"
                                    class="form-control @error('proyek_id') is-invalid @enderror" required>
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

                        <!-- Tahapan -->
                        <div class="mb-3">
                            <label class="form-label">Tahapan <span class="text-danger">*</span></label>
                            <select name="tahap_id"
                                    class="form-control @error('tahap_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Tahapan --</option>
                                @foreach ($tahapans as $tahapan)
                                    <option value="{{ $tahapan->tahap_id }}"
                                        data-proyek-id="{{ $tahapan->proyek_id }}"
                                        {{ old('tahap_id') == $tahapan->tahap_id ? 'selected' : '' }}>
                                        {{ $tahapan->nama_tahapan }} ({{ $tahapan->proyek->nama_proyek ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('tahap_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Progress <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal"
                                   class="form-control @error('tanggal') is-invalid @enderror"
                                   value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Persen Real -->
                        <div class="mb-3">
                            <label class="form-label">Persentase Real Progress <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="persen_real"
                                       class="form-control @error('persen_real') is-invalid @enderror"
                                       value="{{ old('persen_real') }}"
                                       min="0" max="100" step="0.01" required>
                                <span class="input-group-text">%</span>
                            </div>
                            @error('persen_real')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Contoh: 25.5 atau 100</small>
                        </div>

                        <!-- Foto Progress (Utama) -->
                        <div class="mb-3">
                            <label class="form-label">Foto Progress <span class="text-muted">(Opsional)</span></label>
                            <input type="file" name="foto_progres"
                                   class="form-control @error('foto_progres') is-invalid @enderror"
                                   accept="image/*" id="foto_progres_input">
                            @error('foto_progres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>

                            <!-- Preview jika ada -->
                            <div id="preview-container" class="mt-2 d-none">
                                <img id="preview-image" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <!-- Multiple Foto Tambahan -->
                        <div class="mb-3">
                            <label class="form-label">Foto Tambahan <span class="text-muted">(Opsional, max 5 file)</span></label>
                            <input type="file" name="foto_tambahan[]"
                                   class="form-control @error('foto_tambahan') is-invalid @enderror"
                                   accept="image/*" multiple id="foto_tambahan_input">
                            @error('foto_tambahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Dapat memilih lebih dari satu foto</small>

                            <!-- Preview multiple -->
                            <div id="multiple-preview-container" class="row mt-2"></div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" rows="3"
                                      class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('progres.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Progress
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const proyekSelect = document.querySelector('select[name="proyek_id"]');
    const tahapSelect = document.querySelector('select[name="tahap_id"]');
    const fotoInput = document.getElementById('foto_progres_input');
    const multipleFotoInput = document.getElementById('foto_tambahan_input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const multiplePreviewContainer = document.getElementById('multiple-preview-container');

    // Filter tahapan berdasarkan proyek yang dipilih
    proyekSelect.addEventListener('change', function() {
        const selectedProyekId = this.value;
        const tahapOptions = tahapSelect.querySelectorAll('option');

        tahapOptions.forEach(option => {
            if (option.value === '') {
                option.disabled = false;
                return;
            }

            const proyekId = option.getAttribute('data-proyek-id');
            if (proyekId !== selectedProyekId) {
                option.disabled = true;
            } else {
                option.disabled = false;
            }
        });

        // Reset pilihan tahapan jika tidak sesuai
        const selectedTahap = tahapSelect.value;
        const selectedOption = tahapSelect.querySelector(`option[value="${selectedTahap}"]`);
        if (selectedOption && selectedOption.disabled) {
            tahapSelect.value = '';
        }
    });

    // Preview foto utama
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('d-none');
        }
    });

    // Preview multiple foto
    multipleFotoInput.addEventListener('change', function(e) {
        const files = e.target.files;
        multiplePreviewContainer.innerHTML = '';

        Array.from(files).forEach((file, index) => {
            if (index < 5) { // Batasi preview 5 file
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-2';
                    col.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;">
                            <div class="card-body p-2">
                                <small class="text-muted">${file.name.substring(0, 15)}${file.name.length > 15 ? '...' : ''}</small>
                            </div>
                        </div>
                    `;
                    multiplePreviewContainer.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Trigger change jika proyek sudah dipilih
    if (proyekSelect.value) {
        proyekSelect.dispatchEvent(new Event('change'));
    }
});
</script>

<style>
#preview-container img {
    max-width: 100%;
    border-radius: 5px;
}
</style>
@endsection
