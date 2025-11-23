@extends('layouts.guest.app')
@section('title', 'Daftar Data Warga')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>Data Warga
            </h5>
            <a href="{{ route('warga.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Warga
            </a>
        </div>
    </div>

    <div class="card-body">
        <!-- Form Filter dan Search -->
        <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
            <div class="row g-2">
                <!-- Filter Jenis Kelamin -->
                <div class="col-md-3">
                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Filter Agama -->
                <div class="col-md-3">
                    <select name="agama" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Agama</option>
                        <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0"
                               value="{{ request('search') }}" placeholder="Cari">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-outline-danger">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Reset Filter -->
                @if(request('jenis_kelamin') || request('agama') || request('search'))
                    <div class="col-md-2">
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    </div>
                @endif
            </div>
        </form>

        <!-- Info Hasil Pencarian -->
        @if(request('search') || request('jenis_kelamin') || request('agama'))
            <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle me-2"></i>
                @if(request('search'))
                    Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                @endif
                @if(request('jenis_kelamin'))
                    | Filter: <strong>{{ request('jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan' }}</strong>
                @endif
                @if(request('agama'))
                    | Agama: <strong>{{ request('agama') }}</strong>
                @endif
                <span class="badge bg-primary ms-2">{{ $warga->total() }} hasil ditemukan</span>
            </div>
        @endif

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
            <div class="alert alert-warning text-center py-4">
                <i class="fas fa-users fa-3x mb-3 opacity-25"></i>
                <br>
                @if(request('search') || request('jenis_kelamin') || request('agama'))
                    <h6 class="fw-bold">Tidak ditemukan data warga dengan filter yang dipilih</h6>
                    <small>Silakan coba dengan filter atau kata kunci lain</small>
                @else
                    <h6 class="fw-bold">Belum ada data warga</h6>
                    <small>Klik tombol "Tambah Warga" untuk menambah data</small>
                @endif
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

        <!-- Pagination dan Info -->

                <!-- Pagination Links -->
                @if($warga->hasPages())
                    <div >
                        {{ $warga->links('pagination::bootstrap-5') }}
                    </div>


                <!-- Empty space for alignment -->
                <div style="width: 100px;"></div>
            </div>
        @endif
        @endif
    </div>
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

/* Sembunyikan info pagination bawaan */
.pagination .small.text-muted {
    display: none !important;
}
</style>

<!-- Pastikan Font Awesome tersedia -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
