@extends('layouts.guest.app')
@section('title', 'Edit Progress Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Progress Proyek
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('progres.update', $progres->progres_id) }}" method="POST" enctype="multipart/form-data">
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
                            <select name="proyek_id"
                                    class="form-control @error('proyek_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($proyeks as $proyek)
                                    <option value="{{ $proyek->proyek_id }}"
                                        {{ old('proyek_id', $progres->proyek_id) == $proyek->proyek_id ? 'selected' : '' }}>
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
                                        {{ old('tahap_id', $progres->tahap_id) == $tahapan->tahap_id ? 'selected' : '' }}>
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
                                   value="{{ old('tanggal', $progres->tanggal->format('Y-m-d')) }}" required>
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
                                       value="{{ old('persen_real', $progres->persen_real) }}"
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

                            @if($progres->foto_progres)
                                <div class="mb-2">
                                    <p>Foto Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $progres->foto_progres) }}"
                                         alt="Foto saat ini"
                                         class="img-thumbnail"
                                         style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="hapus_foto" id="hapus_foto" class="form-check-input" value="1">
                                        <label for="hapus_foto" class="form-check-label text-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus foto ini
                                        </label>
                                    </div>
                                </div>
                                <p class="text-muted mb-2">Atau ganti dengan foto baru:</p>
                            @endif

                            <input type="file" name="foto_progres"
                                   class="form-control @error('foto_progres') is-invalid @enderror"
                                   accept="image/*" id="foto_progres_input">
                            @error('foto_progres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>

                            <!-- Preview jika ada -->
                            <div id="preview-container" class="mt-2 d-none">
                                <p>Preview Foto Baru:</p>
                                <img id="preview-image" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <!-- Multiple Foto Tambahan -->
                        <div class="mb-3">
                            <label class="form-label">Foto Tambahan</label>

                            <!-- Foto Tambahan Saat Ini -->
                            @if($progres->fotos->count() > 0)
                                <div class="mb-3">
                                    <p>Foto Tambahan Saat Ini:</p>
                                    <div class="row">
                                        @foreach($progres->fotos as $foto)
                                            <div class="col-md-3 mb-2">
                                                <div class="card">
                                                    <img src="{{ asset('storage/' . $foto->file_path) }}"
                                                         class="card-img-top"
                                                         alt="{{ $foto->original_name }}"
                                                         style="height: 100px; object-fit: cover;">
                                                    <div class="card-body p-2">
                                                        <small class="text-muted d-block">{{ $foto->original_name }}</small>
                                                        <button type="button" class="btn btn-sm btn-danger mt-1 hapus-foto-btn"
                                                                data-foto-id="{{ $foto->id }}"
                                                                data-progres-id="{{ $progres->progres_id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Tambah Foto Baru -->
                            <p class="mb-2">Tambah Foto Baru:</p>
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
                                      class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan', $progres->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('progres.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <div>
                                <a href="{{ route('progres.show', $progres->progres_id) }}" class="btn btn-info me-2">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Progress
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
    const proyekSelect = document.querySelector('select[name="proyek_id"]');
    const tahapSelect = document.querySelector('select[name="tahap_id"]');
    const fotoInput = document.getElementById('foto_progres_input');
    const multipleFotoInput = document.getElementById('foto_tambahan_input');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const multiplePreviewContainer = document.getElementById('multiple-preview-container');
    const hapusFotoCheckbox = document.getElementById('hapus_foto');

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

            // Uncheck hapus foto jika ada
            if (hapusFotoCheckbox) {
                hapusFotoCheckbox.checked = false;
            }
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

    // Hapus foto tambahan
    document.querySelectorAll('.hapus-foto-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fotoId = this.getAttribute('data-foto-id');
            const progresId = this.getAttribute('data-progres-id');

            if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                fetch(`/progres/${progresId}/foto/${fotoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.col-md-3').remove();
                        alert('Foto berhasil dihapus');
                    } else {
                        alert('Gagal menghapus foto: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus foto');
                });
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
