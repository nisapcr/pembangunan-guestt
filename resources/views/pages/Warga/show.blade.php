@extends('layouts.guest.app')
@section('title', 'Detail Data Warga - PembangunanProyek')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-eye me-2"></i>Detail Data Warga
                        </h4>
                        <div>
                            <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('warga.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">No KTP / NIK</label>
                                <p class="form-control-plaintext">{{ $warga->no_ktp }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <p class="form-control-plaintext">{{ $warga->nama }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                <p class="form-control-plaintext">
                                    @if($warga->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">Laki-laki</span>
                                    @else
                                        <span class="badge bg-pink">Perempuan</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Agama</label>
                                <p class="form-control-plaintext">{{ $warga->agama }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pekerjaan</label>
                                <p class="form-control-plaintext">{{ $warga->pekerjaan }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Telepon</label>
                                <p class="form-control-plaintext">{{ $warga->telp }}</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext">
                                    @if($warga->email)
                                        {{ $warga->email }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Info Data</label>
                                <div class="card bg-light">
                                    <div class="card-body py-2">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            Dibuat: {{ $warga->created_at->format('d/m/Y H:i') }}<br>
                                            <i class="fas fa-sync me-1"></i>
                                            Diupdate: {{ $warga->updated_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
}

.bg-pink {
    background-color: #e83e8c !important;
}

.form-control-plaintext {
    padding: 0.375rem 0;
    margin-bottom: 0;
    line-height: 1.5;
    background-color: transparent;
    border: solid transparent;
    border-width: 1px 0;
}
</style>
@endsection
