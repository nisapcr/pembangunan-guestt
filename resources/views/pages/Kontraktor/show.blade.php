@extends('layouts.guest.app')
@section('title', 'Detail Kontraktor')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Main Card -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-hard-hat me-2"></i>Detail Kontraktor
                    </h5>
                    <div class="btn-group">
                        <a href="{{ route('kontraktor.edit', $kontraktor->kontraktor_id) }}"
                           class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('kontraktor.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Profile Header -->
                    <div class="text-center mb-4">
                        <div class="avatar-lg bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-hard-hat fa-2x"></i>
                        </div>
                        <h3 class="fw-bold mb-1">{{ $kontraktor->nama }}</h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-project-diagram me-1"></i>
                            {{ $kontraktor->proyek->nama_proyek ?? '-' }}
                        </p>
                    </div>

                    <!-- Detail Cards -->
                    <div class="row mb-4">
                        <!-- Kontak Info -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom">
                                    <h6 class="mb-0">
                                        <i class="fas fa-id-card text-primary me-2"></i>
                                        Informasi Kontak
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="40%">Penanggung Jawab</th>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    {{ $kontraktor->penanggung_jawab }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Kontak</th>
                                            <td>
                                                @if($kontraktor->kontak_valid)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                                        <i class="fas fa-phone text-success"></i>
                                                    </div>
                                                    <div>
                                                        <a href="tel:{{ $kontraktor->kontak }}" class="text-decoration-none">
                                                            {{ $kontraktor->kontak_formatted }}
                                                        </a>
                                                        <br>
                                                        <small class="text-muted">
                                                            Klik untuk menghubungi
                                                        </small>
                                                    </div>
                                                </div>
                                                @else
                                                <span class="text-muted">{{ $kontraktor->kontak }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Proyek Info -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white border-bottom">
                                    <h6 class="mb-0">
                                        <i class="fas fa-project-diagram text-success me-2"></i>
                                        Informasi Proyek
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <th width="40%">Nama Proyek</th>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $kontraktor->proyek->nama_proyek ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $kontraktor->proyek->lokasi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $kontraktor->proyek->tahun ?? '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0">
                                <i class="fas fa-map-marker-alt text-warning me-2"></i>
                                Alamat
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="bg-light p-3 rounded">
                                <i class="fas fa-map-pin text-danger me-2"></i>
                                {{ $kontraktor->alamat }}
                            </div>
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
                                                {{ $kontraktor->created_at->format('d F Y H:i') }}
                                                <br>
                                                <small>{{ $kontraktor->created_at->diffForHumans() }}</small>
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
                                                {{ $kontraktor->updated_at->format('d F Y H:i') }}
                                                <br>
                                                <small>{{ $kontraktor->updated_at->diffForHumans() }}</small>
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
                        <form action="{{ route('kontraktor.destroy', $kontraktor->kontraktor_id) }}"
                              method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontraktor ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i> Hapus Kontraktor
                            </button>
                        </form>
                        <div>
                            <a href="{{ route('kontraktor.edit', $kontraktor->kontraktor_id) }}"
                               class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('kontraktor.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list me-1"></i> Semua Kontraktor
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

.avatar-lg {
    flex-shrink: 0;
}

.table-borderless th {
    font-weight: 600;
    color: #495057;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.rounded-circle {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
}
</style>
@endsection
