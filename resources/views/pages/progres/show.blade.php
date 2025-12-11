@extends('layouts.guest.app')
@section('title', 'Detail Progress Proyek')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Main Progress Card -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Detail Progress Proyek
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('progres.edit', $progres->progres_id) }}"
                           class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('progres.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Progress Overview Card -->
                    <div class="card border-0 shadow-sm mb-4 bg-light">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="fw-bold text-primary mb-1">
                                        {{ $progres->tahapan->nama_tahapan ?? '-' }}
                                    </h4>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-project-diagram me-1"></i>
                                        {{ $progres->proyek->nama_proyek ?? '-' }}
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1" style="height: 15px;">
                                            <div class="progress-bar
                                                @if($progres->persen_real >= 80) bg-success
                                                @elseif($progres->persen_real >= 50) bg-warning
                                                @else bg-danger
                                                @endif"
                                                 role="progressbar"
                                                 style="width: {{ $progres->persen_real }}%">
                                            </div>
                                        </div>
                                        <span class="ms-3 fw-bold fs-4">
                                            {{ $progres->persen_real }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <div class="badge bg-info fs-6 p-2 mb-2">
                                        {{ \Carbon\Carbon::parse($progres->tanggal)->format('d M Y') }}
                                    </div>
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $progres->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Cards Row -->
                    <div class="row mb-4">
                        <!-- Project Info Card -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom">
                                    <h6 class="mb-0">
                                        <i class="fas fa-project-diagram text-primary me-2"></i>
                                        Informasi Proyek
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="40%">Nama Proyek</th>
                                            <td>{{ $progres->proyek->nama_proyek ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $progres->proyek->lokasi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $progres->proyek->tahun ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Detail Card -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom">
                                    <h6 class="mb-0">
                                        <i class="fas fa-chart-line text-success me-2"></i>
                                        Detail Progress
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="40%">Tahapan</th>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $progres->tahapan->nama_tahapan ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Target</th>
                                            <td>
                                                {{ $progres->tahapan->target_persen ?? 0 }}%
                                                @php
                                                    $diff = $progres->persen_real - ($progres->tahapan->target_persen ?? 0);
                                                @endphp
                                                @if($diff > 0)
                                                <span class="badge bg-success ms-2">
                                                    <i class="fas fa-arrow-up me-1"></i>{{ number_format(abs($diff), 1) }}%
                                                </span>
                                                @elseif($diff < 0)
                                                <span class="badge bg-danger ms-2">
                                                    <i class="fas fa-arrow-down me-1"></i>{{ number_format(abs($diff), 1) }}%
                                                </span>
                                                @else
                                                <span class="badge bg-info ms-2">Tepat target</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status Tahapan</th>
                                            <td>
                                                @if($progres->tahapan->status == 'pending')
                                                    <span class="badge bg-secondary">Pending</span>
                                                @elseif($progres->tahapan->status == 'in_progress')
                                                    <span class="badge bg-warning">In Progress</span>
                                                @else
                                                    <span class="badge bg-success">Completed</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Gallery Card -->
                    @if($progres->foto_progres || $progres->fotos->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-camera text-warning me-2"></i>
                                Galeri Foto Progress
                                <span class="badge bg-primary ms-2">
                                    {{ $progres->fotos->count() + ($progres->foto_progres ? 1 : 0) }}
                                </span>
                            </h6>
                            <button class="btn btn-sm btn-outline-primary" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#photoGallery">
                                <i class="fas fa-expand-alt"></i>
                            </button>
                        </div>
                        <div class="collapse show" id="photoGallery">
                            <div class="card-body">
                                <!-- Main Photo -->
                                @if($progres->foto_progres)
                                <div class="text-center mb-4">
                                    <h6 class="text-primary mb-3">Foto Utama</h6>
                                    <img src="{{ asset('storage/' . $progres->foto_progres) }}"
                                         class="img-fluid rounded shadow-lg"
                                         alt="Foto Progress Utama"
                                         style="max-height: 400px;">
                                </div>
                                @endif

                                <!-- Additional Photos -->
                                @if($progres->fotos->count() > 0)
                                <h6 class="text-primary mb-3">
                                    Foto Tambahan ({{ $progres->fotos->count() }})
                                </h6>
                                <div class="row">
                                    @foreach($progres->fotos as $foto)
                                    <div class="col-md-3 mb-3">
                                        <div class="card border-0 shadow-sm h-100">
                                            <img src="{{ asset('storage/' . $foto->file_path) }}"
                                                 class="card-img-top"
                                                 alt="{{ $foto->original_name }}"
                                                 style="height: 150px; object-fit: cover;">
                                            <div class="card-body p-2 text-center">
                                                <small class="text-muted d-block">
                                                    {{ $foto->original_name }}
                                                </small>
                                                <small class="text-muted">
                                                    {{ round($foto->file_size / 1024, 1) }} KB
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Note Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0">
                                <i class="fas fa-sticky-note text-info me-2"></i>
                                Catatan Progress
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($progres->catatan)
                            <div class="bg-light p-3 rounded">
                                {{ $progres->catatan }}
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-sticky-note fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Tidak ada catatan</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Timeline Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0">
                                <i class="fas fa-history text-secondary me-2"></i>
                                Timeline
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary rounded-circle p-2">
                                                <i class="fas fa-plus text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Dibuat</h6>
                                            <p class="mb-0 text-muted">
                                                {{ $progres->created_at->format('d F Y H:i') }}
                                                <br>
                                                <small>{{ $progres->created_at->diffForHumans() }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="bg-success rounded-circle p-2">
                                                <i class="fas fa-sync text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Terakhir Diupdate</h6>
                                            <p class="mb-0 text-muted">
                                                {{ $progres->updated_at->format('d F Y H:i') }}
                                                <br>
                                                <small>{{ $progres->updated_at->diffForHumans() }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-white border-top">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('progres.destroy', $progres->progres_id) }}"
                              method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus progress ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Hapus Progress
                            </button>
                        </form>
                        <div>
                            <a href="{{ route('progres.edit', $progres->progres_id) }}"
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('progres.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list me-1"></i> Semua Progress
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    overflow: hidden;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
    font-weight: 600;
}

.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391) !important;
}

.progress-bar {
    border-radius: 4px;
}

.table-borderless th {
    font-weight: 600;
    color: #495057;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.collapse.show {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.rounded-circle {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}

.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add image zoom effect
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('click', function() {
            if (!this.classList.contains('zoomed')) {
                this.classList.add('zoomed');
                this.style.cursor = 'zoom-out';
                this.style.transform = 'scale(1.5)';
                this.style.transition = 'transform 0.3s ease';
                this.style.zIndex = '1000';
            } else {
                this.classList.remove('zoomed');
                this.style.cursor = 'pointer';
                this.style.transform = 'scale(1)';
                this.style.zIndex = '1';
            }
        });
    });
});
</script>
@endsection
