@extends('layouts.guest.app')
@section('title', 'Daftar Data Proyek')

@section('content')
<div class="container-fluid">
    <!-- Header Card dengan Filter dan Search -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-project-diagram me-2"></i>Data Proyek
                </h5>
                <a href="{{ route('proyek.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Proyek
                </a>
            </div>
        </div>

        <div class="card-body">
            <!-- Form Filter dan Search -->
            <form method="GET" action="{{ route('proyek.index') }}" class="mb-4">
                <div class="row g-2">
                    <!-- Filter Tahun -->
                    <div class="col-md-2">
                        <select name="tahun" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $years = range($currentYear, $currentYear - 10);
                            @endphp
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Sumber Dana -->
                    <div class="col-md-3">
                        <select name="sumber_dana" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Sumber Dana</option>
                            <option value="APBN" {{ request('sumber_dana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                            <option value="APBD Provinsi" {{ request('sumber_dana') == 'APBD Provinsi' ? 'selected' : '' }}>APBD Provinsi</option>
                            <option value="APBD Kabupaten/Kota" {{ request('sumber_dana') == 'APBD Kabupaten/Kota' ? 'selected' : '' }}>APBD Kabupaten/Kota</option>
                            <option value="Hibah" {{ request('sumber_dana') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                            <option value="Swasta" {{ request('sumber_dana') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                            <option value="Pinjaman Luar Negeri" {{ request('sumber_dana') == 'Pinjaman Luar Negeri' ? 'selected' : '' }}>Pinjaman Luar Negeri</option>
                        </select>
                    </div>

                    <!-- Filter Lokasi -->
                    <div class="col-md-2">
                        <select name="lokasi" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Lokasi</option>
                            @php
                                $lokasiList = \App\Models\Proyek::select('lokasi')->distinct()->pluck('lokasi');
                            @endphp
                            @foreach($lokasiList as $lokasi)
                                <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>
                                    {{ $lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search -->
                    <div class="col-md-3">
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
                    @if(request('tahun') || request('sumber_dana') || request('lokasi') || request('search'))
                        <div class="col-md-2">
                            <a href="{{ route('proyek.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-refresh me-1"></i> Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            <!-- Info Hasil Pencarian -->
            @if(request('tahun') || request('sumber_dana') || request('lokasi') || request('search'))
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    @if(request('search'))
                        Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                    @endif
                    @if(request('tahun'))
                        | Tahun: <strong>{{ request('tahun') }}</strong>
                    @endif
                    @if(request('sumber_dana'))
                        | Sumber Dana: <strong>{{ request('sumber_dana') }}</strong>
                    @endif
                    @if(request('lokasi'))
                        | Lokasi: <strong>{{ request('lokasi') }}</strong>
                    @endif
                    <span class="badge bg-primary ms-2">{{ $proyek->total() }} hasil ditemukan</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4 mx-2">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Proyek</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProyek ?? 0 }}</div>
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
                                Rp 35.15 M
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proyekAktif ?? 0 }}</div>
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

    <!-- Sumber Dana Statistics - VERSI SESUAI GAMBAR BARU -->
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
                        <div class="progress" style="height: 25px; border-radius: 12px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 21.0%" title="Hibah: 21.0%"></div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 16.0%" title="APBN: 16.0%"></div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 24.0%" title="Swasta: 24.0%"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 13.0%" title="APBD Kabupaten/Kota: 13.0%"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 18.0%" title="APBD Provinsi: 18.0%"></div>
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 8.0%" title="Pinjaman Luar Negeri: 8.0%"></div>
                        </div>
                    </div>

                    <!-- Statistics Grid - Layout Baru -->
                    <div class="row">
                        <!-- Hibah -->
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-primary me-3">
                                    <i class="fas fa-gift text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-primary fw-bold">21</h4>
                                    <p class="mb-1 fw-bold text-dark">Hibah</p>
                                    <small class="text-primary fw-bold">21.0%</small>
                                </div>
                            </div>
                        </div>

                        <!-- APBD Kabupaten/Kota -->
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-warning me-3">
                                    <i class="fas fa-city text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-warning fw-bold">13</h4>
                                    <p class="mb-1 fw-bold text-dark">APBD Kabupaten/Kota</p>
                                    <small class="text-warning fw-bold">13.0%</small>
                                </div>
                            </div>
                        </div>

                        <!-- APBN -->
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-success me-3">
                                    <i class="fas fa-landmark text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-success fw-bold">16</h4>
                                    <p class="mb-1 fw-bold text-dark">APBN</p>
                                    <small class="text-success fw-bold">16.0%</small>
                                </div>
                            </div>
                        </div>

                        <!-- APBD Provinsi -->
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-danger me-3">
                                    <i class="fas fa-flag text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-danger fw-bold">18</h4>
                                    <p class="mb-1 fw-bold text-dark">APBD Provinsi</p>
                                    <small class="text-danger fw-bold">18.0%</small>
                                </div>
                            </div>
                        </div>

                        <!-- Swasta -->
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-info me-3">
                                    <i class="fas fa-building text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-info fw-bold">24</h4>
                                    <p class="mb-1 fw-bold text-dark">Swasta</p>
                                    <small class="text-info fw-bold">24.0%</small>
                                </div>
                            </div>
                        </div>

                        <!-- Pinjaman Luar Negeri -->
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-secondary me-3">
                                    <i class="fas fa-globe-americas text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-secondary fw-bold">8</h4>
                                    <p class="mb-1 fw-bold text-dark">Pinjaman Luar Negeri</p>
                                    <small class="text-secondary fw-bold">8.0%</small>
                                </div>
                            </div>
                        </div>
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
        <div class="alert alert-warning text-center py-4 mx-2">
            <i class="fas fa-info-circle fa-2x mb-3 opacity-25"></i>
            <br>
            @if(request('search') || request('tahun') || request('sumber_dana') || request('lokasi'))
                <h6 class="fw-bold">Tidak ditemukan data proyek dengan filter yang dipilih</h6>
                <small>Silakan coba dengan filter atau kata kunci lain</small>
            @else
                <h6 class="fw-bold">Belum ada data proyek</h6>
                <small>Silakan tambah proyek baru dengan mengklik tombol "Tambah Proyek"</small>
            @endif
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

    <!-- Pagination Links -->
    @if($proyek->hasPages())
        <div>
            {{ $proyek->links('pagination::bootstrap-5') }}
        </div>
    @endif
    @endif
</div>

<style>
.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.progress-bar {
    position: relative;
}

.progress-bar:hover::after {
    content: attr(title);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
}

/* Sembunyikan info pagination bawaan */
.pagination .small.text-muted {
    display: none !important;
}
</style>
@endsection
