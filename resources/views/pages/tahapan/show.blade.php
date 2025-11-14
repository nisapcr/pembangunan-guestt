@extends('layouts.guest.app')
@section('title', 'Detail Tahapan Proyek')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Detail Tahapan Proyek</h3>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th>Nama Tahapan</th>
                    <td>{{ $tahapan->nama_tahapan }}</td>
                </tr>
                <tr>
                    <th>Proyek</th>
                    <td>{{ $tahapan->proyek->nama_proyek ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Target (%)</th>
                    <td>{{ $tahapan->target_persen }}%</td>
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>{{ $tahapan->tanggal_mulai->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td>{{ $tahapan->tanggal_selesai->format('d M Y') }}</td>
                </tr>
            </table>

            <a href="{{ route('tahapan.index') }}" class="btn btn-secondary mt-3">Kembali</a>

        </div>
    </div>

</div>
@endsection
