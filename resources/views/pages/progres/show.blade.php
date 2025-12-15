@extends('layouts.guest.app')
@section('title', 'Detail Progress Proyek')

@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-lg-8 mx-auto">

<div class="card shadow border-0 mb-4">

{{-- ================= HEADER ================= --}}
<div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0">
        <i class="fas fa-info-circle me-2"></i> Detail Progress Proyek
    </h5>
    <div class="btn-group">
        <a href="{{ route('progres.edit', $progres->progres_id) }}" class="btn btn-light btn-sm">
            <i class="fas fa-edit me-1"></i> Edit
        </a>
        <a href="{{ route('progres.index') }}" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<div class="card-body">

{{-- ================= OVERVIEW ================= --}}
<div class="card border-0 shadow-sm mb-4 bg-light">
<div class="card-body">
<div class="row align-items-center">

<div class="col-md-8">
    <h4 class="fw-bold text-primary mb-1">
        {{ optional($progres->tahapan)->nama_tahapan ?? '-' }}
    </h4>
    <p class="text-muted mb-2">
        <i class="fas fa-project-diagram me-1"></i>
        {{ optional($progres->proyek)->nama_proyek ?? '-' }}
    </p>

    <div class="d-flex align-items-center">
        <div class="progress flex-grow-1" style="height:15px">
            <div class="progress-bar
                {{ $progres->persen_real >= 80 ? 'bg-success' : ($progres->persen_real >= 50 ? 'bg-warning' : 'bg-danger') }}"
                style="width: {{ $progres->persen_real }}%">
            </div>
        </div>
        <span class="ms-3 fw-bold fs-4">{{ $progres->persen_real }}%</span>
    </div>
</div>

<div class="col-md-4 text-md-end mt-3 mt-md-0">
    <span class="badge bg-info fs-6 p-2">
        {{ $progres->tanggal?->format('d M Y') ?? '-' }}
    </span>
    <br>
    <small class="text-muted">
        <i class="fas fa-clock me-1"></i>
        {{ $progres->created_at->diffForHumans() }}
    </small>
</div>

</div>
</div>
</div>

{{-- ================= FOTO ================= --}}
@if($progres->foto_progres || $progres->fotos->count())
<div class="card border-0 shadow-sm mb-4">
<div class="card-header bg-white">
    <h6 class="mb-0">
        <i class="fas fa-camera text-warning me-2"></i> Galeri Foto
    </h6>
</div>

<div class="card-body">

@if($progres->foto_progres)
<div class="text-center mb-4">
    <img src="{{ asset('storage/'.$progres->foto_progres) }}"
         class="img-fluid rounded shadow-lg zoomable"
         style="max-height:400px">
</div>
@endif

@if($progres->fotos->count())
<div class="row">
@foreach($progres->fotos as $foto)
<div class="col-md-3 mb-3">
    <img src="{{ asset('storage/'.$foto->file_path) }}"
         class="img-thumbnail zoomable"
         style="height:150px;object-fit:cover">
</div>
@endforeach
</div>
@endif

</div>
</div>
@endif

{{-- ================= CATATAN ================= --}}
<div class="card border-0 shadow-sm mb-4">
<div class="card-header bg-white">
    <h6 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Catatan</h6>
</div>
<div class="card-body">
    {{ $progres->catatan ?? 'Tidak ada catatan' }}
</div>
</div>

</div>

{{-- ================= FOOTER ================= --}}
<div class="card-footer bg-white d-flex justify-content-between">
<form action="{{ route('progres.destroy', $progres->progres_id) }}"
      method="POST"
      onsubmit="return confirm('Yakin hapus progress ini?')">
@csrf
@method('DELETE')
<button class="btn btn-danger">
    <i class="fas fa-trash me-1"></i> Hapus
</button>
</form>

<a href="{{ route('progres.index') }}" class="btn btn-secondary">
    <i class="fas fa-list me-1"></i> Semua Progress
</a>
</div>

</div>
</div>
</div>
</div>

{{-- ================= ZOOM SCRIPT ================= --}}
<script>
document.querySelectorAll('.zoomable').forEach(img => {
    img.addEventListener('click', () => {
        img.classList.toggle('zoomed');
    });
});
</script>

<style>
.bg-gradient-info {
    background: linear-gradient(45deg, #36b9cc, #258391);
}
.zoomable {
    cursor: zoom-in;
    transition: transform .3s;
}
.zoomable.zoomed {
    transform: scale(1.5);
    cursor: zoom-out;
    z-index: 999;
}
</style>
@endsection
