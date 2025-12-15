@extends('layouts.guest.app')
@section('title', 'Edit Progress Proyek')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">

                <div class="card shadow">
                    <div class="card-header bg-warning text-white">
                        <h5><i class="fas fa-edit me-2"></i>Edit Progress Proyek</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('progres.update', $progres->progres_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- ================= PROYEK ================= --}}
                            <div class="mb-3">
                                <label>Proyek <span class="text-danger">*</span></label>
                                <select name="proyek_id" id="proyek_id" class="form-control" required>
                                    <option value="">-- Pilih Proyek --</option>
                                    @foreach ($proyeks as $p)
                                        <option value="{{ $p->proyek_id }}"
                                            {{ old('proyek_id', $progres->proyek_id) == $p->proyek_id ? 'selected' : '' }}>
                                            {{ $p->nama_proyek }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ================= TAHAPAN ================= --}}
                            <div class="mb-3">
                                <label>Tahapan <span class="text-danger">*</span></label>
                                <select name="tahap_id" id="tahap_id" class="form-control" required>
                                    <option value="">-- Pilih Tahapan --</option>
                                    @foreach ($tahapans as $t)
                                        <option value="{{ $t->id }}" data-proyek-id="{{ $t->proyek_id }}"
                                            {{ old('tahap_id', $progres->tahap_id) == $t->id ? 'selected' : '' }}>
                                            {{ $t->nama_tahapan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- ================= TANGGAL ================= --}}
                            <div class="mb-3">
                                <label>Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal"
                                    value="{{ old('tanggal', $progres->tanggal->format('Y-m-d')) }}" class="form-control"
                                    required>
                            </div>

                            {{-- ================= PERSEN ================= --}}
                            <div class="mb-3">
                                <label>Persentase <span class="text-danger">*</span></label>
                                <input type="number" name="persen_real"
                                    value="{{ old('persen_real', $progres->persen_real) }}" class="form-control"
                                    min="0" max="100" step="0.01" required>
                            </div>

                            {{-- ================= FOTO UTAMA ================= --}}
                            <div class="mb-3">
                                <label>Foto Progress Utama</label>

                                @if ($progres->foto_progres)
                                    <img src="{{ asset('storage/' . $progres->foto_progres) }}" class="img-thumbnail mb-2"
                                        style="max-height:200px">

                                    <div class="form-check">
                                        <input type="checkbox" name="hapus_foto" value="1" class="form-check-input">
                                        <label class="form-check-label text-danger">Hapus foto utama</label>
                                    </div>
                                @endif

                                <input type="file" name="foto_progres" class="form-control" accept="image/*">
                            </div>

                            {{-- ================= FOTO TAMBAHAN ================= --}}
                            <div class="mb-3">
                                <label>Foto Tambahan</label>

                                @if ($progres->fotos->count())
                                    <div class="row mb-2">
                                        @foreach ($progres->fotos as $foto)
                                            <div class="col-md-3">
                                                <img src="{{ asset('storage/' . $foto->file_path) }}" class="img-thumbnail">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="file" name="foto_tambahan[]" class="form-control" multiple accept="image/*">
                            </div>

                            {{-- ================= CATATAN ================= --}}
                            <div class="mb-3">
                                <label>Catatan</label>
                                <textarea name="catatan" class="form-control">{{ old('catatan', $progres->catatan) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('progres.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= JS FILTER TAHAPAN FIX ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const proyek = document.getElementById('proyek_id');
            const tahap = document.getElementById('tahap_id');

            function filterTahapan(reset = false) {
                const proyekId = proyek.value;
                [...tahap.options].forEach(opt => {
                    if (!opt.value) return;
                    opt.hidden = proyekId && opt.dataset.proyekId !== proyekId;
                });
                if (reset) tahap.value = '';
            }

            filterTahapan();
            proyek.addEventListener('change', () => filterTahapan(true));
        });
    </script>
@endsection
