@extends('layouts.guest.app')
@section('title', 'Daftar Tahapan Proyek')

@section('content')
<div class="container-fluid">

        <a href="{{ route('tahapan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Tahapan
        </a>
    </div>
<br>
    <!-- Enhanced Statistics Cards -->
    <div class="row mb-4 mx-2">
        <!-- Total Tahapan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $totalTahapan }}</h2>
                            <p class="mb-0 opacity-75">Total Tahapan</p>
                            <small class="opacity-75">
                                <i class="fas fa-chart-line me-1"></i>
                                {{ $totalTahapan > 0 ? number_format(($tahapanSelesai / $totalTahapan) * 100, 1) : 0 }}% Selesai
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-list-alt"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $totalTahapan > 0 ? ($tahapanSelesai / $totalTahapan) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $tahapanSelesai }}</h2>
                            <p class="mb-0 opacity-75">Selesai</p>
                            <small class="opacity-75">
                                <i class="fas fa-check me-1"></i>
                                {{ $totalTahapan > 0 ? number_format(($tahapanSelesai / $totalTahapan) * 100, 1) : 0 }}% dari Total
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $totalTahapan > 0 ? ($tahapanSelesai / $totalTahapan) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dalam Proses -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-warning text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $tahapanInProgress }}</h2>
                            <p class="mb-0 opacity-75">Dalam Proses</p>
                            <small class="opacity-75">
                                <i class="fas fa-sync-alt me-1"></i>
                                {{ $totalTahapan > 0 ? number_format(($tahapanInProgress / $totalTahapan) * 100, 1) : 0 }}% dari Total
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $totalTahapan > 0 ? ($tahapanInProgress / $totalTahapan) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card statistic-card bg-gradient-secondary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="font-weight-bold mb-1">{{ $tahapanPending }}</h2>
                            <p class="mb-0 opacity-75">Pending</p>
                            <small class="opacity-75">
                                <i class="fas fa-clock me-1"></i>
                                {{ $totalTahapan > 0 ? number_format(($tahapanPending / $totalTahapan) * 100, 1) : 0 }}% dari Total
                            </small>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                        <div class="progress-bar bg-white"
                             style="width: {{ $totalTahapan > 0 ? ($tahapanPending / $totalTahapan) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card View -->
    <div class="mx-2">
        @if ($tahapans->isEmpty())
            <div class="alert alert-warning text-center py-4">
                <i class="fas fa-info-circle fa-2x mb-3"></i>
                <h5>Belum ada data tahapan proyek</h5>
                <p class="mb-0">Silakan tambah tahapan proyek baru dengan mengklik tombol "Tambah Tahapan"</p>
            </div>
        @else
            <div class="row">
                @foreach ($tahapans as $item)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-{{
                        $item->status == 'completed' ? 'success' :
                        ($item->status == 'in_progress' ? 'warning' : 'secondary')
                    }}">
                        <!-- Card Header -->
                        <div class="card-header bg-{{
                            $item->status == 'completed' ? 'success' :
                            ($item->status == 'in_progress' ? 'warning' : 'secondary')
                        }} text-white">
                            <h6 class="card-title mb-1 fw-bold">{{ $item->nama_tahapan }}</h6>
                            <small class="opacity-75">
                                <i class="fas fa-building me-1"></i>
                                {{ $item->proyek->nama_proyek ?? '-' }}
                            </small>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- Progress Bar -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small class="fw-bold">Progress Target</small>
                                    <small class="fw-bold">{{ $item->target_persen }}%</small>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar
                                        @if($item->target_persen >= 80) bg-success
                                        @elseif($item->target_persen >= 50) bg-warning
                                        @else bg-danger
                                        @endif"
                                         role="progressbar" style="width: {{ $item->target_persen }}%"
                                         aria-valuenow="{{ $item->target_persen }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-play-circle text-primary me-1"></i>
                                        Mulai
                                    </small>
                                    <small class="fw-bold">
                                        @if($item->tanggal_mulai)
                                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </small>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-flag-checkered text-success me-1"></i>
                                        Selesai
                                    </small>
                                    <small class="fw-bold">
                                        @if($item->tanggal_selesai)
                                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </small>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="d-flex justify-content-between align-items-center">
                                @php
                                    if($item->status == 'pending') {
                                        $color = 'secondary';
                                        $icon = 'clock';
                                        $text = 'Pending';
                                    } elseif($item->status == 'in_progress') {
                                        $color = 'warning';
                                        $icon = 'spinner';
                                        $text = 'Dalam Proses';
                                    } elseif($item->status == 'completed') {
                                        $color = 'success';
                                        $icon = 'check-circle';
                                        $text = 'Selesai';
                                    } else {
                                        $color = 'dark';
                                        $icon = 'question';
                                        $text = $item->status;
                                    }
                                @endphp
                                <span class="badge bg-{{ $color }}">
                                    <i class="fas fa-{{ $icon }} me-1"></i>
                                    {{ $text }}
                                </span>

                                <!-- Days Info -->
                                @if($item->tanggal_mulai && $item->tanggal_selesai)
                                    @php
                                        $start = \Carbon\Carbon::parse($item->tanggal_mulai);
                                        $end = \Carbon\Carbon::parse($item->tanggal_selesai);
                                        $days = $start->diffInDays($end);
                                    @endphp
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-day me-1"></i>
                                        {{ $days }} hari
                                    </small>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer - Actions -->
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('tahapan.show', $item->tahap_id) }}"
                                   class="btn btn-outline-info btn-sm" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tahapan.edit', $item->tahap_id) }}"
                                   class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tahapan.destroy', $item->tahap_id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus tahapan {{ $item->nama_tahapan }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
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

.bg-gradient-secondary {
    background: linear-gradient(45deg, #858796, #5a5c69) !important;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391) !important;
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

/* Progress Chart */
.overall-progress {
    overflow: visible;
    position: relative;
}

.progress-bar {
    position: relative;
    transition: all 0.5s ease;
}

.progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-weight: bold;
    font-size: 0.8rem;
    color: white;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}

.legend-color {
    width: 15px;
    height: 15px;
    border-radius: 3px;
}

.legend-item small {
    font-weight: 500;
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

.card-text {
    line-height: 1.4;
}

/* Tambahkan space untuk card */
.col-xl-4, .col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
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

@media (max-width: 576px) {
    .container-fluid {
        padding-left: 10px;
        padding-right: 10px;
    }

    .mx-2 {
        margin-left: 5px !important;
        margin-right: 5px !important;
    }

    .progress-text {
        font-size: 0.7rem;
    }
}
</style>
@endsection
