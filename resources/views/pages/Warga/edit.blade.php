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

    <!-- Enhanced Statistics Cards - Mengikuti style tahapan -->
    @if(isset($totalProyek) && $totalProyek >= 0)
    <div class="row mb-4 mx-2">
        <!-- Total Proyek -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $totalProyek ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Total Proyek</p>
                            <small class="opacity-75">
                                <i class="fas fa-chart-line me-1"></i>
                                @php
                                    $persenSelesai = ($totalProyek > 0 && isset($proyekSelesai)) ?
                                        number_format(($proyekSelesai / $totalProyek) * 100, 1) : 0;
                                @endphp
                                {{ $persenSelesai }}% Selesai
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $persenSelesai }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Anggaran -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">Rp {{ number_format(($totalAnggaran ?? 0) / 1000000000, 2) }} M</h2>
                            <p class="mb-0 opacity-75">Total Anggaran</p>
                            <small class="opacity-75">
                                <i class="fas fa-money-bill-wave me-1"></i>
                                Rata-rata Rp {{ $totalProyek > 0 ? number_format(($totalAnggaran ?? 0) / $totalProyek / 1000000, 2) : 0 }} M
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proyek Aktif -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $proyekAktif ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Proyek Aktif</p>
                            <small class="opacity-75">
                                <i class="fas fa-sync-alt me-1"></i>
                                @php
                                    $persenAktif = ($totalProyek > 0 && isset($proyekAktif)) ?
                                        number_format(($proyekAktif / $totalProyek) * 100, 1) : 0;
                                @endphp
                                {{ $persenAktif }}% dari Total
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $persenAktif }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proyek Selesai -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-info text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $proyekSelesai ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Proyek Selesai</p>
                            <small class="opacity-75">
                                <i class="fas fa-check me-1"></i>
                                @php
                                    $persenSelesai = ($totalProyek > 0 && isset($proyekSelesai)) ?
                                        number_format(($proyekSelesai / $totalProyek) * 100, 1) : 0;
                                @endphp
                                {{ $persenSelesai }}% dari Total
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $persenSelesai }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Sumber Dana Statistics - Diperbaiki dengan style yang konsisten -->
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

                    <!-- Statistics Grid - Diperbaiki dengan style yang konsisten -->
                    <div class="row">
                        @php
                            $sumberDanaData = [
                                ['count' => 21, 'name' => 'Hibah', 'percentage' => '21.0%', 'color' => 'primary', 'icon' => 'gift'],
                                ['count' => 16, 'name' => 'APBN', 'percentage' => '16.0%', 'color' => 'success', 'icon' => 'landmark'],
                                ['count' => 24, 'name' => 'Swasta', 'percentage' => '24.0%', 'color' => 'info', 'icon' => 'building'],
                                ['count' => 13, 'name' => 'APBD Kabupaten/Kota', 'percentage' => '13.0%', 'color' => 'warning', 'icon' => 'city'],
                                ['count' => 18, 'name' => 'APBD Provinsi', 'percentage' => '18.0%', 'color' => 'danger', 'icon' => 'flag'],
                                ['count' => 8, 'name' => 'Pinjaman Luar Negeri', 'percentage' => '8.0%', 'color' => 'secondary', 'icon' => 'globe-americas']
                            ];
                        @endphp

                        @foreach($sumberDanaData as $data)
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded h-100">
                                <div class="icon-circle bg-{{ $data['color'] }} me-3">
                                    <i class="fas fa-{{ $data['icon'] }} text-white fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="mb-1 text-{{ $data['color'] }} fw-bold">{{ $data['count'] }}</h4>
                                    <p class="mb-1 fw-bold text-dark">{{ $data['name'] }}</p>
                                    <small class="text-{{ $data['color'] }} fw-bold">{{ $data['percentage'] }}</small>
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
            <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-2" role="alert">
            <i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
    <!-- Card View - Diperbaiki dengan style yang konsisten -->
    <div class="mx-2">
        <div class="row">
            @foreach($proyek as $item)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-{{
                    // Anda bisa menambahkan status proyek jika ada, atau gunakan tahun sebagai indikator
                    $item->tahun == date('Y') ? 'success' :
                    ($item->tahun > date('Y') ? 'warning' : 'secondary')
                }}">
                    <!-- Card Header -->
                    <div class="card-header bg-{{
                        $item->tahun == date('Y') ? 'success' :
                        ($item->tahun > date('Y') ? 'warning' : 'secondary')
                    }} text-white">
                        <h6 class="card-title mb-1 fw-bold">{{ Str::limit($item->nama_proyek, 40) }}</h6>
                        <small class="opacity-75">
                            <i class="fas fa-barcode me-1"></i> {{ $item->kode_proyek }}
                        </small>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Progress Bar untuk anggaran atau progress proyek -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="fw-bold">Anggaran Proyek</small>
                                <small class="fw-bold">Rp {{ number_format($item->anggaran / 1000000, 1) }} JT</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                @php
                                    // Contoh progress berdasarkan anggaran (bisa disesuaikan dengan logika bisnis)
                                    $progressPercent = min(100, ($item->anggaran / 100000000) * 100);
                                @endphp
                                <div class="progress-bar
                                    @if($progressPercent >= 80) bg-success
                                    @elseif($progressPercent >= 50) bg-warning
                                    @else bg-primary
                                    @endif"
                                     role="progressbar" style="width: {{ $progressPercent }}%"
                                     aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Proyek -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <small class="text-muted d-block">
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                    Lokasi
                                </small>
                                <small class="fw-bold">{{ Str::limit($item->lokasi, 15) }}</small>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">
                                    <i class="fas fa-calendar text-success me-1"></i>
                                    Tahun
                                </small>
                                <small class="fw-bold">{{ $item->tahun }}</small>
                            </div>
                        </div>

                        <!-- Sumber Dana & Status -->
                        <div class="d-flex justify-content-between align-items-center">
                            @php
                                // Mapping warna untuk sumber dana
                                $sumberDanaColors = [
                                    'Hibah' => 'primary',
                                    'APBN' => 'success',
                                    'Swasta' => 'info',
                                    'APBD Kabupaten/Kota' => 'warning',
                                    'APBD Provinsi' => 'danger',
                                    'Pinjaman Luar Negeri' => 'secondary'
                                ];
                                $color = $sumberDanaColors[$item->sumber_dana] ?? 'dark';
                            @endphp
                            <span class="badge bg-{{ $color }}">
                                <i class="fas fa-money-bill-wave me-1"></i>
                                {{ $item->sumber_dana }}
                            </span>

                            <!-- Status berdasarkan tahun -->
                            @php
                                $currentYear = date('Y');
                                if($item->tahun == $currentYear) {
                                    $statusText = 'Berjalan';
                                    $statusIcon = 'play-circle';
                                } elseif($item->tahun > $currentYear) {
                                    $statusText = 'Akan Datang';
                                    $statusIcon = 'clock';
                                } else {
                                    $statusText = 'Selesai';
                                    $statusIcon = 'check-circle';
                                }
                            @endphp
                            <small class="text-muted">
                                <i class="fas fa-{{ $statusIcon }} me-1"></i>
                                {{ $statusText }}
                            </small>
                        </div>

                        <!-- Deskripsi -->
                        @if($item->deskripsi)
                        <div class="mt-3 pt-3 border-top">
                            <small class="text-muted d-block mb-1">Deskripsi:</small>
                            <p class="mb-0 text-muted small line-clamp-2">{{ $item->deskripsi }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Card Footer - Actions -->
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
            <div class="d-flex justify-content-center mt-4">
                {{ $proyek->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
    @endif
</div>

<style>
.container-fluid {
    padding-left: 20px;
    padding-right: 20px;
}

/* Enhanced Statistic Cards */
.statistic-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.statistic-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2) !important;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe) !important;
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #13855c) !important;
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f6c23e, #dda20a) !important;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391) !important;
}

.bg-gradient-secondary {
    background: linear-gradient(45deg, #858796, #5a5c69) !important;
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

/* Card Styles */
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border-radius: 10px;
    margin: 5px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    border-bottom: none;
}

.card-footer {
    border-radius: 0 0 10px 10px !important;
    border-top: 1px solid rgba(0,0,0,0.05);
}

.btn-group .btn {
    border-radius: 5px;
    margin: 0 1px;
    flex: 1;
}

.progress {
    border-radius: 10px;
    background-color: #f0f0f0;
}

.badge {
    font-size: 0.75em;
    padding: 0.5em 0.8em;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Sembunyikan info pagination bawaan */
.pagination .small.text-muted {
    display: none !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-xl-4 {
        margin-bottom: 1rem;
    }

    .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }

    .mx-2 {
        margin-left: 10px !important;
        margin-right: 10px !important;
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>
@endsection
