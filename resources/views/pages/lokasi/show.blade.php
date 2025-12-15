<!-- resources/views/pages/lokasi/show.blade.php -->
@extends('layouts.guest.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3>
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $lokasi->nama_lokasi }}
                </h3>
                <div class="btn-group">
                    <a href="{{ route('lokasi.edit', $lokasi->lokasi_id) }}"
                       class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8">
            <!-- Basic Info Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Lokasi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Lokasi</th>
                            <td>{{ $lokasi->nama_lokasi }}</td>
                        </tr>
                        <tr>
                            <th>Proyek</th>
                            <td>{{ $lokasi->proyek->nama_proyek ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $lokasi->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Koordinat</th>
                            <td>
                                @if($lokasi->lat && $lokasi->lng)
                                    {{ $lokasi->lat }}, {{ $lokasi->lng }}
                                    <a href="https://maps.google.com/?q={{ $lokasi->lat }},{{ $lokasi->lng }}"
                                       target="_blank" class="btn btn-sm btn-info ms-2">
                                        <i class="fas fa-map"></i> View Map
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada koordinat</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ $lokasi->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>{{ $lokasi->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Denah Image -->
            @if($lokasi->denah_gambar)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Denah Gambar</h5>
                    <a href="{{ Storage::url($lokasi->denah_gambar) }}"
                       target="_blank" class="btn btn-sm btn-primary">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($lokasi->denah_gambar) }}"
                         alt="Denah {{ $lokasi->nama_lokasi }}"
                         class="img-fluid rounded"
                         style="max-height: 400px;">
                </div>
            </div>
            @endif

            <!-- Media Gallery -->
            @php
                $mediaItems = [];
                if (is_array($lokasi->media_tambahan)) {
                    $mediaItems = $lokasi->media_tambahan;
                }
                $mediaCount = count($mediaItems);
            @endphp

            @if($mediaCount > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Media Tambahan ({{ $mediaCount }})</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($mediaItems as $index => $media)
                        @php
                            $isImage = isset($media['mime']) && str_starts_with($media['mime'], 'image/');
                            $fileUrl = isset($media['path']) ? Storage::url($media['path']) : '#';
                            $fileName = $media['original_name'] ?? 'File ' . ($index + 1);
                        @endphp
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    @if($isImage)
                                        <img src="{{ $fileUrl }}"
                                             alt="{{ $fileName }}"
                                             class="img-fluid rounded mb-2"
                                             style="height: 100px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-file fa-3x text-secondary mb-2"></i>
                                    @endif
                                    <h6 class="text-truncate" title="{{ $fileName }}">
                                        {{ Str::limit($fileName, 15) }}
                                    </h6>
                                    <small class="text-muted">
                                        {{ isset($media['size']) ? round($media['size'] / 1024, 1) : 0 }} KB
                                    </small>
                                </div>
                                <div class="card-footer p-2">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ $fileUrl }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('lokasi.download-media', ['id' => $lokasi->lokasi_id, 'index' => $index]) }}"
                                           class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-md-4">
            <!-- Actions Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('lokasi.edit', $lokasi->lokasi_id) }}"
                           class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Lokasi
                        </a>

                        <form action="{{ route('lokasi.destroy', $lokasi->lokasi_id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus lokasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Hapus Lokasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Denah Gambar</span>
                            @if($lokasi->denah_gambar)
                                <span class="badge bg-success">Ada</span>
                            @else
                                <span class="badge bg-secondary">Tidak ada</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Media Tambahan</span>
                            <span class="badge bg-primary">{{ $mediaCount }} file</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Koordinat</span>
                            @if($lokasi->lat && $lokasi->lng)
                                <span class="badge bg-success">Lengkap</span>
                            @else
                                <span class="badge bg-warning">Tidak lengkap</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
