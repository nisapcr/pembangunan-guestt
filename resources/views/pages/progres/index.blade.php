@extends('layouts.guest.app')
@section('title', 'Daftar Progres Proyek')

@section('content')
<div class="container-fluid">
    <!-- Header Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-chart-line me-2"></i>Data Progress Proyek
            </h5>
            <a href="{{ route('progres.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> Tambah Progress
            </a>
        </div>

        <!-- Filter Section -->
        <div class="card-body">
            <form method="GET" action="{{ route('progres.index') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-3">
                        <select name="proyek_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Proyek</option>
                            @foreach($proyeks as $proyek)
                                <option value="{{ $proyek->proyek_id }}"
                                    {{ request('proyek_id') == $proyek->proyek_id ? 'selected' : '' }}>
                                    {{ $proyek->nama_proyek }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="tahap_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tahapan</option>
                            @foreach($tahapans as $tahapan)
                                <option value="{{ $tahapan->tahap_id }}"
                                    {{ request('tahap_id') == $tahapan->tahap_id ? 'selected' : '' }}>
                                    {{ $tahapan->nama_tahapan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}" placeholder="Cari catatan...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                   class="btn btn-outline-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(request('proyek_id') || request('tahap_id') || request('search'))
                    <div class="col-md-2">
                        <a href="{{ route('progres.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i> Reset
                        </a>
                    </div>
                    @endif
                </div>
            </form>

            <!-- Search Info -->
            @if(request('proyek_id') || request('tahap_id') || request('search'))
            <div class="alert alert-info mb-0">
                <i class="fas fa-info-circle me-2"></i>
                @if(request('search'))
                    Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"
                @endif
                @if(request('proyek_id'))
                    | Proyek: <strong>
                        @php
                            $selectedProyek = $proyeks->where('proyek_id', request('proyek_id'))->first();
                        @endphp
                        {{ $selectedProyek->nama_proyek ?? 'Tidak Diketahui' }}
                    </strong>
                @endif
                @if(request('tahap_id'))
                    | Tahapan: <strong>
                        @php
                            $selectedTahapan = $tahapans->where('tahap_id', request('tahap_id'))->first();
                        @endphp
                        {{ $selectedTahapan->nama_tahapan ?? 'Tidak Diketahui' }}
                    </strong>
                @endif
                <span class="badge bg-primary ms-2">{{ $progress->total() }} data ditemukan</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-primary text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $totalProgress ?? 0 }}</h2>
                            <p class="mb-0 opacity-75">Total Progress</p>
                            <small class="opacity-75">
                                <i class="fas fa-chart-bar me-1"></i>Data Progress
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-info text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ number_format($avgProgress ?? 0, 1) }}%</h2>
                            <p class="mb-0 opacity-75">Rata-rata</p>
                            <small class="opacity-75">
                                <i class="fas fa-calculator me-1"></i>Persentase
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-success text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ number_format($maxProgress ?? 0, 1) }}%</h2>
                            <p class="mb-0 opacity-75">Tertinggi</p>
                            <small class="opacity-75">
                                <i class="fas fa-arrow-up me-1"></i>Maksimum
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-trophy"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-warning text-white shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ number_format($minProgress ?? 0, 1) }}%</h2>
                            <p class="mb-0 opacity-75">Terendah</p>
                            <small class="opacity-75">
                                <i class="fas fa-arrow-down me-1"></i>Minimum
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Progress Cards -->
    <div class="row">
        @if ($progress->isEmpty())
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-info-circle fa-3x text-muted mb-3 opacity-25"></i>
                    @if(request('search') || request('proyek_id') || request('tahap_id'))
                    <h5 class="fw-bold text-muted">Tidak ditemukan data progress dengan filter yang dipilih</h5>
                    <p class="text-muted">Silakan coba dengan filter atau kata kunci lain</p>
                    @else
                    <h5 class="fw-bold text-muted">Belum ada data progress proyek</h5>
                    <p class="text-muted">Silakan tambah progress proyek baru dengan mengklik tombol "Tambah Progress"</p>
                    @endif
                    <a href="{{ route('progres.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-1"></i> Tambah Progress Pertama
                    </a>
                </div>
            </div>
        </div>
        @else
            @foreach ($progress as $item)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card progress-card shadow-sm border-0 h-100">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold mb-1 text-primary">
                                    {{ $item->tahapan->nama_tahapan ?? '-' }}
                                </h6>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-project-diagram me-1"></i>
                                    {{ $item->proyek->nama_proyek ?? '-' }}
                                </p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary border-0"
                                        type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('progres.show', $item->progres_id) }}">
                                            <i class="fas fa-eye text-info me-2"></i>Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('progres.edit', $item->progres_id) }}">
                                            <i class="fas fa-edit text-warning me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('progres.destroy', $item->progres_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Hapus progress ini?')">
                                                <i class="fas fa-trash me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pt-2">
                        <!-- Progress Bar -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Progress</span>
                                <span class="fw-bold {{ $item->persen_real >= 80 ? 'text-success' : ($item->persen_real >= 50 ? 'text-warning' : 'text-danger') }}">
                                    {{ $item->persen_real }}%
                                </span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar
                                    @if($item->persen_real >= 80) bg-success
                                    @elseif($item->persen_real >= 50) bg-warning
                                    @else bg-danger
                                    @endif"
                                    role="progressbar"
                                    style="width: {{ $item->persen_real }}%">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">Target: {{ $item->tahapan->target_persen ?? 0 }}%</small>
                                @php
                                    $diff = $item->persen_real - ($item->tahapan->target_persen ?? 0);
                                @endphp
                                @if($diff > 0)
                                <small class="text-success">
                                    <i class="fas fa-arrow-up me-1"></i>{{ number_format(abs($diff), 1) }}%
                                </small>
                                @elseif($diff < 0)
                                <small class="text-danger">
                                    <i class="fas fa-arrow-down me-1"></i>{{ number_format(abs($diff), 1) }}%
                                </small>
                                @else
                                <small class="text-info">Tepat target</small>
                                @endif
                            </div>
                        </div>

                        <!-- Date & Photo -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-2">
                                        <i class="fas fa-calendar text-primary"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Tanggal</small>
                                        <span class="fw-bold">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-2">
                                        <i class="fas fa-camera text-success"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Foto</small>
                                        <span class="fw-bold">
                                            {{ $item->fotos->count() + ($item->foto_progres ? 1 : 0) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Preview -->
                        @if($item->catatan)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1">Catatan:</small>
                            <p class="mb-0 text-truncate-2" style="max-height: 3em; overflow: hidden;">
                                {{ $item->catatan }}
                            </p>
                            <button type="button" class="btn btn-sm btn-link p-0 mt-1"
                                    data-bs-toggle="modal" data-bs-target="#catatanModal{{ $item->progres_id }}">
                                Baca selengkapnya
                            </button>
                        </div>
                        @endif

                        <!-- Photo Preview -->
                        @if($item->foto_progres || $item->fotos->count() > 0)
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Foto Progress:</small>
                            <div class="row g-2">
                                @if($item->foto_progres)
                                <div class="col-4">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $item->foto_progres) }}"
                                             alt="Foto Progress"
                                             class="img-fluid rounded shadow-sm cursor-pointer"
                                             data-bs-toggle="modal"
                                             data-bs-target="#fotoModal{{ $item->progres_id }}"
                                             style="height: 80px; width: 100%; object-fit: cover;"
                                             onerror="this.onerror=null; this.src='{{ asset('img/placeholder-progress.png') }}';">
                                        <span class="position-absolute top-0 start-0 bg-primary text-white px-1 py-0 rounded-end small">
                                            Utama
                                        </span>
                                    </div>
                                </div>
                                @else
                                <!-- Placeholder untuk foto utama -->
                                <div class="col-4">
                                    <div class="position-relative">
                                        <div class="img-placeholder rounded shadow-sm cursor-pointer d-flex flex-column align-items-center justify-content-center"
                                             data-bs-toggle="modal"
                                             data-bs-target="#fotoModal{{ $item->progres_id }}"
                                             style="height: 80px; width: 100%; background-color: #f8f9fa;">
                                            <img src="{{ asset('img/placeholder-progress.png') }}"
                                                 alt="Placeholder Foto"
                                                 style="height: 40px; width: 40px; opacity: 0.6;"
                                                 class="mb-1">
                                            <span class="text-muted small">No Photo</span>
                                        </div>
                                        <span class="position-absolute top-0 start-0 bg-secondary text-white px-1 py-0 rounded-end small">
                                            Utama
                                        </span>
                                    </div>
                                </div>
                                @endif

                                @php
                                    $fotoTambahan = $item->fotos->take(3 - 1);
                                    $totalTampil = 1 + $fotoTambahan->count();
                                    $totalFoto = $item->fotos->count() + ($item->foto_progres ? 1 : 1);
                                @endphp

                                @foreach($fotoTambahan as $foto)
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $foto->file_path) }}"
                                         alt="Foto Tambahan"
                                         class="img-fluid rounded shadow-sm cursor-pointer"
                                         data-bs-toggle="modal"
                                         data-bs-target="#fotoModal{{ $item->progres_id }}"
                                         style="height: 80px; width: 100%; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='{{ asset('img/placeholder-progress.png') }}';">
                                </div>
                                @endforeach

                                @if($totalFoto > 3)
                                <div class="col-4">
                                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center cursor-pointer"
                                         style="height: 80px;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#fotoModal{{ $item->progres_id }}">
                                        <span class="text-primary fw-bold">
                                            +{{ $totalFoto - 3 }}
                                        </span>
                                        <small class="text-muted">Foto</small>
                                    </div>
                                </div>
                                @elseif($totalFoto <1)
                                    @for($i = $totalFoto; $i < 1; $i++)
                                    <div class="col-4">
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="height: 80px;">
                                            <i class="fas fa-plus text-muted"></i>
                                        </div>
                                    </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        @else
                        <!-- Placeholder ketika tidak ada foto sama sekali -->
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Foto Progress:</small>
                                <div class="col-4">
                                    <div class="position-relative">
                                        <div class="img-placeholder rounded shadow-sm cursor-pointer d-flex flex-column align-items-center justify-content-center"
                                             data-bs-toggle="modal"
                                             data-bs-target="#fotoModal{{ $item->progres_id }}"
                                             style="height: 80px; width: 100%; background-color: #f8f9fa;">
                                            <img src="{{ asset('img/placeholder-progress.png') }}"
                                                 alt="Placeholder Foto"
                                                 style="height: 40px; width: 40px; opacity: 0.6;"
                                                 class="mb-1">
                                            <span class="text-muted small">No Photo</span>
                                        </div>
                                        <span class="position-absolute top-0 start-0 bg-secondary text-white px-1 py-0 rounded-end small">
                                            Utama
                                        </span>
                                    </div>
                                </div>

                                <!-- Placeholder untuk foto tambahan -->
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i>Belum ada foto yang diupload
                            </small>
                        </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-white border-0 pt-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $item->created_at->diffForHumans() }}
                            </small>
                            <div class="btn-group">
                                @if($item->foto_progres || $item->fotos->count() > 0)
                                <button class="btn btn-sm btn-outline-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fotoModal{{ $item->progres_id }}">
                                    <i class="fas fa-images"></i>
                                </button>
                                @endif
                                <a href="{{ route('progres.show', $item->progres_id) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('progres.edit', $item->progres_id) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Foto -->
            <div class="modal fade" id="fotoModal{{ $item->progres_id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-images me-2"></i>
                                Foto Progress - {{ $item->tahapan->nama_tahapan ?? '-' }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @if($item->foto_progres)
                            <div class="text-center mb-4">
                                <h6 class="text-primary mb-2">Foto Utama</h6>
                                <img src="{{ asset('storage/' . $item->foto_progres) }}"
                                     class="img-fluid rounded shadow"
                                     alt="Foto Progress"
                                     style="max-height: 400px;"
                                     onerror="this.onerror=null; this.src='{{ asset('img/placeholder-progress.png') }}';">
                            </div>
                            @else
                            <!-- Placeholder dalam modal -->
                            <div class="text-center mb-4">
                                <h6 class="text-primary mb-2">Foto Utama</h6>
                                <div class="bg-light rounded shadow d-flex flex-column align-items-center justify-content-center"
                                     style="height: 300px; max-height: 400px;">
                                    <img src="{{ asset('img/placeholder-progress.png') }}"
                                         alt="Placeholder Foto"
                                         style="height: 100px; width: 100px; opacity: 0.5;"
                                         class="mb-3">
                                    <h5 class="text-muted">Tidak ada foto utama</h5>
                                    <p class="text-muted small">Foto belum diupload untuk progress ini</p>
                                </div>
                            </div>
                            @endif

                            @if($item->fotos->count() > 0)
                            <h6 class="text-primary mb-3">
                                Foto Tambahan ({{ $item->fotos->count() }})
                            </h6>
                            <div class="row">
                                @foreach($item->fotos as $foto)
                                <div class="col-md-4 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="{{ asset('storage/' . $foto->file_path) }}"
                                             class="card-img-top"
                                             alt="{{ $foto->original_name }}"
                                             style="height: 200px; object-fit: cover;"
                                             onerror="this.onerror=null; this.src='{{ asset('img/placeholder-progress.png') }}';">
                                        <div class="card-body p-2">
                                            <small class="text-muted d-block">{{ $foto->original_name }}</small>
                                            <small class="text-muted">{{ round($foto->file_size / 1024, 1) }} KB</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center mt-4">
                                <h6 class="text-primary mb-3">Foto Tambahan</h6>
                                <div class="bg-light rounded p-4">
                                    <img src="{{ asset('img/placeholder-progress.png') }}"
                                         alt="Placeholder Foto"
                                         style="height: 80px; width: 80px; opacity: 0.5;"
                                         class="mb-3">
                                    <p class="text-muted mb-0">Tidak ada foto tambahan</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal untuk Catatan -->
            <div class="modal fade" id="catatanModal{{ $item->progres_id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-sticky-note me-2"></i>
                                Catatan Progress
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $item->catatan }}</p>
                        </div>
                        <div class="modal-footer">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- Pagination -->
    @if($progress->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body py-3">
                    <div >
                        <div>
                            {{ $progress->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.progress-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    overflow: hidden;
}

.progress-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    border-color: #4e73df;
}

.statistic-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.statistic-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2) !important;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe) !important;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391) !important;
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #13855c) !important;
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f6c23e, #dda20a) !important;
}

.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.cursor-pointer {
    cursor: pointer;
}

.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.progress-card .card-header {
    border-bottom: 1px solid #e9ecef;
}

.progress-card .card-footer {
    border-top: 1px solid #e9ecef;
}

.dropdown-menu {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

/* Placeholder styles */
.img-placeholder {
    transition: all 0.3s ease;
    border: 1px dashed #dee2e6;
}

.img-placeholder:hover {
    background-color: #e9ecef !important;
    border-color: #4e73df;
}

/* Responsive */
@media (max-width: 768px) {
    .progress-card {
        margin-bottom: 1rem;
    }

    .statistic-card .icon-circle {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .statistic-card h2 {
        font-size: 1.5rem;
    }
}
</style>

<script>
// Initialize popovers
document.addEventListener('DOMContentLoaded', function() {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    // Add hover effect for cards
    const cards = document.querySelectorAll('.progress-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });

    // Fallback for broken images
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            this.src = '{{ asset('img/placeholder-progress.png') }}';
            this.style.opacity = '0.7';
        });
    });
});
</script>
@endsection
