{{-- resources/views/pages/proyek/show.blade.php --}}
@extends('layouts.guest.app')
@section('title', 'Detail Proyek: ' . $proyek->nama_proyek)

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>Detail Proyek
                        </h5>
                        <a href="{{ route('proyek.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Alert untuk menampilkan pesan --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        {{-- Informasi Utama --}}
                        <div class="col-md-8">
                            <h4 class="text-primary mb-3">{{ $proyek->nama_proyek }}</h4>

                            <div class="row mb-3">
                                <div class="col-sm-4 fw-bold">Kode Proyek:</div>
                                <div class="col-sm-8">
                                    <span class="badge bg-secondary">{{ $proyek->kode_proyek }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4 fw-bold">Lokasi:</div>
                                <div class="col-sm-8">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $proyek->lokasi }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4 fw-bold">Tahun:</div>
                                <div class="col-sm-8">
                                    <i class="fas fa-calendar text-warning me-2"></i>{{ $proyek->tahun }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4 fw-bold">Sumber Dana:</div>
                                <div class="col-sm-8">
                                    <i class="fas fa-money-bill-wave text-success me-2"></i>{{ $proyek->sumber_dana }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4 fw-bold">Anggaran:</div>
                                <div class="col-sm-8">
                                    <i class="fas fa-coins text-warning me-2"></i>Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}
                                </div>
                            </div>

                            @if($proyek->deskripsi)
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="fw-bold mb-2">Deskripsi Proyek:</div>
                                    <div class="border rounded p-3 bg-light">
                                        {!! nl2br(e($proyek->deskripsi)) !!}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Sidebar Informasi Tambahan --}}
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0"><i class="fas fa-file-alt me-2"></i>Dokumen</h6>
                                </div>
                                <div class="card-body text-center">
                                    @if($proyek->dokumen)
                                        <div class="mb-3">
                                            <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                        </div>
                                        <a href="{{ Storage::url($proyek->dokumen) }}"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm mb-2">
                                            <i class="fas fa-download me-1"></i>Download Dokumen
                                        </a>
                                        <p class="small text-muted mb-0">
                                            File: {{ basename($proyek->dokumen) }}
                                        </p>
                                    @else
                                        <div class="mb-3">
                                            <i class="fas fa-file-excel fa-3x text-muted"></i>
                                        </div>
                                        <p class="text-muted small">Tidak ada dokumen</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Informasi Metadata --}}
                            <div class="card bg-light mt-3">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <div class="mb-1">
                                            <i class="fas fa-calendar-plus me-2"></i>
                                            Dibuat: {{ $proyek->created_at->format('d/m/Y H:i') }}
                                        </div>
                                        <div>
                                            <i class="fas fa-calendar-edit me-2"></i>
                                            Diupdate: {{ $proyek->updated_at->format('d/m/Y H:i') }}
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('proyek.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-1"></i>Daftar Proyek
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('proyek.edit', $proyek->proyek_id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <form action="{{ route('proyek.destroy', $proyek->proyek_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus proyek {{ $proyek->nama_proyek }}?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
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

.badge {
    font-size: 0.9em;
    padding: 0.5em 0.75em;
}

.btn-group .btn {
    margin-left: 5px;
    border-radius: 5px;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endsection
