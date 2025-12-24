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
                @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                    <a href="{{ route('proyek.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Proyek
                    </a>
                @endif
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
                            @php
                                $sumberDanaList = \App\Models\Proyek::select('sumber_dana')->distinct()->pluck('sumber_dana');
                            @endphp
                            @foreach($sumberDanaList as $sumber)
                                <option value="{{ $sumber }}" {{ request('sumber_dana') == $sumber ? 'selected' : '' }}>
                                    {{ $sumber }}
                                </option>
                            @endforeach
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
                                Rp {{ number_format($totalAnggaran, 0, ',', '.') }}
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

    <!-- Sumber Dana Statistics -->
    @if($sumberDanaCount->isNotEmpty())
    <div class="row mb-4 mx-2">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-pie me-2"></i>Distribusi Sumber Dana
                    </h6>
                </div>
                <div class="card-body">
                    @php
                        // Hitung total proyek untuk persentase
                        $totalForPercentage = $totalProyek > 0 ? $totalProyek : 1;
                        $colors = ['bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-secondary', 'bg-dark'];
                        $icons = [
                            'Hibah' => 'fa-gift',
                            'APBN' => 'fa-landmark',
                            'Swasta' => 'fa-building',
                            'APBD Kabupaten/Kota' => 'fa-city',
                            'APBD Provinsi' => 'fa-flag',
                            'Pinjaman Luar Negeri' => 'fa-globe-americas'
                        ];
                        $colorMap = [];
                        $i = 0;
                    @endphp

                    <!-- Progress Bar Overall -->
                    <div class="mb-4">
                        <div class="progress" style="height: 25px; border-radius: 12px;">
                            @foreach($sumberDanaCount as $index => $item)
                                @php
                                    $percentage = ($item->count / $totalForPercentage) * 100;
                                    $colorClass = $colors[$index % count($colors)];
                                    $colorMap[$item->sumber_dana] = str_replace('bg-', '', $colorClass);
                                @endphp
                                <div class="progress-bar {{ $colorClass }}"
                                     role="progressbar"
                                     style="width: {{ $percentage }}%"
                                     title="{{ $item->sumber_dana }}: {{ number_format($percentage, 1) }}%">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Statistics Grid -->
                    <div class="row">
                        @foreach($sumberDanaCount as $index => $item)
                            @php
                                $percentage = ($item->count / $totalForPercentage) * 100;
                                $colorClass = $colors[$index % count($colors)];
                                $colorTextClass = 'text-' . str_replace('bg-', '', $colorClass);
                                $icon = $icons[$item->sumber_dana] ?? 'fa-chart-bar';
                            @endphp
                            <div class="col-lg-4 col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 border rounded h-100">
                                    <div class="icon-circle {{ $colorClass }} me-3">
                                        <i class="fas {{ $icon }} text-white fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h4 class="mb-1 {{ $colorTextClass }} fw-bold">{{ $item->count }}</h4>
                                        <p class="mb-1 fw-bold text-dark">{{ $item->sumber_dana }}</p>
                                        <small class="{{ $colorTextClass }} fw-bold">{{ number_format($percentage, 1) }}%</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

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
        @php
            // Hitung jumlah file untuk proyek ini
            $fileCount = \App\Models\Multipleuploads::where('ref_table', 'proyek')
                ->where('ref_id', $item->proyek_id)
                ->count();

            // Ambil 3 file terbaru untuk preview
            $latestFiles = \App\Models\Multipleuploads::where('ref_table', 'proyek')
                ->where('ref_id', $item->proyek_id)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        @endphp
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white position-relative">
                    <h6 class="card-title mb-1 fw-bold">{{ Str::limit($item->nama_proyek, 40) }}</h6>
                    <small class="card-text opacity-75">
                        <i class="fas fa-barcode me-1"></i> {{ $item->kode_proyek }}
                    </small>

                    <!-- Badge untuk jumlah file -->
                    @if($fileCount > 0)
                    <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-info">
                        {{ $fileCount }} <i class="fas fa-file ms-1"></i>
                    </span>
                    @endif
                </div>

                <div class="card-body">
                    <!-- Preview File Gambar -->
                    @if($latestFiles->where('mime_type', 'like', 'image/%')->count() > 0)
                    <div class="row mb-3">
                        <div class="col-12">
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-images me-1"></i> Preview File
                            </small>
                            <div class="d-flex">
                                @foreach($latestFiles->where('mime_type', 'like', 'image/%')->take(2) as $file)
                                <div class="me-2">
                                    <img src="{{ Storage::url($file->file_path) }}"
                                         class="rounded"
                                         alt="Preview"
                                         style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                         onclick="window.open('{{ Storage::url($file->file_path) }}', '_blank')">
                                </div>
                                @endforeach

                                @if($fileCount > 2)
                                <div class="position-relative" style="width: 60px; height: 60px;">
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                         style="width: 100%; height: 100%;">
                                        <span class="text-white">+{{ $fileCount - 2 }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

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
                        @if(in_array(auth()->user()->role, ['admin', 'petugas']))
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
                        @endif
                    </div>

                    <!-- Quick Action untuk Upload File -->
                    @if(in_array(auth()->user()->role, ['admin', 'petugas']))
                        <div class="mt-2 text-center">
                            <small>
                                <a href="{{ route('proyek.show', $item->proyek_id) }}#uploadForm"
                                   class="text-primary text-decoration-none">
                                    <i class="fas fa-plus-circle me-1"></i>Tambah File
                                </a>
                            </small>
                        </div>
                    @endif
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
    transition: width 0.3s ease;
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

.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

.translate-middle {
    transform: translate(50%, -50%);
}

.badge.rounded-pill {
    font-size: 0.7rem;
    padding: 0.25em 0.6em;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-xl-4 {
        width: 100%;
    }

    .progress {
        height: 20px;
    }

    .icon-circle {
        width: 50px;
        height: 50px;
    }
}
</style>

@push('scripts')
<script>
// Add smooth scrolling for upload link
document.addEventListener('DOMContentLoaded', function() {
    // Handle hash links
    if (window.location.hash) {
        const element = document.querySelector(window.location.hash);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>
@endpush
@endsection
