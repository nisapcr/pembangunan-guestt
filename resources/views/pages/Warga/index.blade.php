@extends('layouts.app')

@section('title', 'Daftar Data Warga')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('warga.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Warga
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
@if ($warga->isEmpty())
    <div class="alert alert-warning text-center">
        <i class="fas fa-info-circle"></i> Data warga tidak ditemukan!
    </div>
@else
<div class="row">
    @foreach($warga as $item)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-1">{{ $item->nama }}</h5>
                <small class="card-text">NIK: {{ $item->no_ktp }}</small>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-5 fw-bold">Jenis Kelamin:</div>
                    <div class="col-7">
                        @if($item->jenis_kelamin == 'L')
                            <i class="fas fa-mars text-primary"></i> Laki-laki
                        @else
                            <i class="fas fa-venus text-danger"></i> Perempuan
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-bold">Agama:</div>
                    <div class="col-7">
                        <i class="fas fa-pray"></i> {{ $item->agama }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-bold">Pekerjaan:</div>
                    <div class="col-7">
                        <i class="fas fa-briefcase"></i> {{ $item->pekerjaan }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-bold">Telepon:</div>
                    <div class="col-7">
                        <i class="fas fa-phone"></i> {{ $item->telp }}
                    </div>
                </div>
                @if($item->email)
                <div class="row mb-2">
                    <div class="col-5 fw-bold">Email:</div>
                    <div class="col-7">
                        <i class="fas fa-envelope"></i> {{ $item->email }}
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer bg-transparent">
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('warga.show', $item->warga_id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data warga {{ $item->nama }}?')">
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
</style>

<!-- Pastikan Font Awesome tersedia -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection