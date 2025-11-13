@extends('layouts.guest.app')
@section('title', 'Daftar Data Proyek')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('proyek.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Proyek
        </a>
    </div>

    {{-- ALERT / NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- CEK DATA --}}
    @if ($proyek->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="fas fa-info-circle"></i> Data proyek tidak ditemukan!
        </div>
    @else
    <div class="row">
        @foreach($proyek as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-1">{{ $item->nama_proyek }}</h5>
                    <small class="card-text">Kode: {{ $item->kode_proyek }}</small>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Lokasi:</div>
                        <div class="col-7">
                            <i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Tahun:</div>
                        <div class="col-7">
                            <i class="fas fa-calendar"></i> {{ $item->tahun }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Sumber Dana:</div>
                        <div class="col-7">
                            <i class="fas fa-money-bill-wave"></i> {{ $item->sumber_dana }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Anggaran:</div>
                        <div class="col-7">
                            <i class="fas fa-coins"></i> Rp {{ number_format($item->anggaran, 0, ',', '.') }}
                        </div>
                    </div>
                    @if($item->deskripsi)
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="fw-bold mb-1">Deskripsi:</div>
                            <p class="mb-0 text-muted small line-clamp-2">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('proyek.show', $item->proyek_id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('proyek.edit', $item->proyek_id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('proyek.destroy', $item->proyek_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus proyek {{ $item->nama_proyek }}?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
    border: none;
    border-radius: 10px;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    border-bottom: none;
}

.btn-group .btn {
    border-radius: 5px;
    margin: 0 2px;
}

.card-title {
    font-weight: 600;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
