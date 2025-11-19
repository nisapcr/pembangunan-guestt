@extends('layouts.guest.app')
@section('title', 'Daftar Data Proyek')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->

        <a href="{{ route('proyek.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Proyek
        </a>
    </div>
<br>
    <!-- Statistics Cards -->
    <div class="row mb-4 mx-2">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Proyek</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProyek }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Anggaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($totalAnggaran / 1000000000, 2) }} M
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Proyek Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proyekAktif }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-play-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Proyek Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proyekSelesai }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flag-checkered fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sumber Dana Statistics - VERSI SINGKAT DAN RAPI -->
    <div class="row mb-4 mx-2">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-pie me-2"></i>Distribusi Sumber Dana
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Progress Bar Overall -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <small class="text-muted"></small>
                            <small class="text-muted">100%</small>
                        </div>
                        <div class="progress" style="height: 20px; border-radius: 10px;">
                            @php
                                $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
                                $colorIndex = 0;
                            @endphp
                            @foreach($sumberDanaCount as $sumber)
                            @php
                                $color = $colors[$colorIndex % count($colors)];
                                $percentage = ($sumber->count / $totalProyek) * 100;
                                $colorIndex++;
                            @endphp
                            <div class="progress-bar bg-{{ $color }}"
                                 role="progressbar"
                                 style="width: {{ $percentage }}%"
                                 title="{{ $sumber->sumber_dana }}: {{ $sumber->count }} proyek ({{ number_format($percentage, 1) }}%)">
                                <span class="progress-text">{{ $sumber->count }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Statistics Grid -->
                    <div class="row">
                        @php
                            $icons = [
                                'Hibah' => 'fas fa-gift',
                                'APBN' => 'fas fa-landmark',
                                'Swasta' => 'fas fa-building',
                                'Pinjaman Luar Negeri' => 'fas fa-globe-americas',
                                'APBD Kabupaten/Kota' => 'fas fa-city',
                                'APBD Provinsi' => 'fas fa-flag'
                            ];
                            $colorIndex = 0;
                        @endphp

                        @foreach($sumberDanaCount as $sumber)
                        @php
                            $color = $colors[$colorIndex % count($colors)];
                            $percentage = ($sumber->count / $totalProyek) * 100;
                            $icon = $icons[$sumber->sumber_dana] ?? 'fas fa-money-bill-wave';
                            $colorIndex++;
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="icon-circle bg-{{ $color }} me-3">
                                    <i class="{{ $icon }} text-white"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1 text-{{ $color }}">{{ $sumber->count }}</h5>
                                    <p class="mb-1 small text-muted">{{ $sumber->sumber_dana }}</p>
                                    <small class="text-{{ $color }} font-weight-bold">
                                        {{ number_format($percentage, 1) }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ALERT / NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-2" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- CEK DATA --}}
    @if ($proyek->isEmpty())
        <div class="alert alert-warning text-center mx-2">
            <i class="fas fa-info-circle"></i> Data proyek tidak ditemukan!
        </div>
    @else
    <div class="row mx-2">
        @foreach($proyek as $item)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="card-title mb-1 fw-bold">{{ Str::limit($item->nama_proyek, 40) }}</h6>
                    <small class="card-text opacity-75">
                        <i class="fas fa-barcode me-1"></i> {{ $item->kode_proyek }}
                    </small>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12">
                            <small class="text-muted d-block">
                                <i class="fas fa-map-marker-alt me-1"></i> Lokasi
                            </small>
                            <small class="fw-bold">{{ $item->lokasi }}</small>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar me-1"></i> Tahun
                            </small>
                            <small class="fw-bold">{{ $item->tahun }}</small>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">
                                <i class="fas fa-money-bill-wave me-1"></i> Sumber Dana
                            </small>
                            <small class="fw-bold">{{ $item->sumber_dana }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <small class="text-muted d-block">
                                <i class="fas fa-coins me-1"></i> Anggaran
                            </small>
                            <small class="fw-bold text-success">Rp {{ number_format($item->anggaran, 0, ',', '.') }}</small>
                        </div>
                    </div>

                    @if($item->deskripsi)
                    <div class="row mb-2">
                        <div class="col-12">
                            <small class="text-muted d-block mb-1">Deskripsi:</small>
                            <p class="mb-0 text-muted small line-clamp-2">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('proyek.show', $item->proyek_id) }}" class="btn btn-outline-info btn-sm" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('proyek.edit', $item->proyek_id) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('proyek.destroy', $item->proyek_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus"
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
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border-radius: 10px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    border-bottom: none;
}

.btn-group .btn {
    border-radius: 5px;
    margin: 0 1px;
    flex: 1;
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

/* Icon Circle */
.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.icon-circle i {
    font-size: 1.2rem;
}

/* Progress Bar dengan text */
.progress {
    position: relative;
}

.progress-bar {
    position: relative;
    border-radius: 10px;
}

.progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    font-weight: bold;
    color: white;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}

/* Gradient Header */
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-xl-4 {
        margin-bottom: 1rem;
    }

    .icon-circle {
        width: 40px;
        height: 40px;
    }

    .icon-circle i {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .col-lg-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endsection
