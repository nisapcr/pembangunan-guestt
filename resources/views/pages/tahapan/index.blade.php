@extends('layouts.guest.app')
@section('title', 'Daftar Tahapan Proyek')

@section('content')
<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('tahapan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Tahapan
        </a>
    </div>

    {{-- ALERT MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($tahapans->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="fas fa-info-circle"></i> Belum ada data tahapan proyek.
        </div>
    @else
    <div class="row">
        @foreach ($tahapans as $item)
        <div class="col-md-6 col-lg-4 mb-4">

            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-1">{{ $item->nama_tahap }}</h5>
                    <small class="card-text">
                        Proyek: {{ $item->proyek->nama_proyek ?? '-' }}
                    </small>
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Target:</div>
                        <div class="col-7">
                            <i class="fas fa-percent"></i> {{ $item->target_persen }}%
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Mulai:</div>
                        <div class="col-7">
                            <i class="fas fa-calendar"></i>
                            {{ optional($item->tgl_mulai)->format('d M Y') ?? '-' }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 fw-bold">Selesai:</div>
                        <div class="col-7">
                            <i class="fas fa-calendar-check"></i>
                            {{ optional($item->tgl_selesai)->format('d M Y') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100">

                        <a href="{{ route('tahapan.show', $item->tahap_id) }}"
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('tahapan.edit', $item->tahap_id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('tahapan.destroy', $item->tahap_id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus tahapan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
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
</style>
@endsection
