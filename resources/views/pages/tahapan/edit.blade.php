@extends('layouts.guest.app')
@section('title', 'Edit Tahapan Proyek')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Edit Tahapan</h3>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('tahapan.update', $tahapan->tahap_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Proyek</label>
                    <select name="proyek_id" class="form-control" required>
                        @foreach ($proyeks as $p)
                            <option value="{{ $p->proyek_id }}"
                                {{ $p->proyek_id == $tahapan->proyek_id ? 'selected' : '' }}>
                                {{ $p->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nama Tahapan</label>
                    <input type="text" name="nama_tahapan" class="form-control"
                           value="{{ $tahapan->nama_tahapan }}" required>
                </div>

                <div class="mb-3">
                    <label>Target Progres (%)</label>
                    <input type="number" name="target_persen" class="form-control"
                           min="0" max="100" value="{{ $tahapan->target_persen }}" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                        value="{{ $tahapan->tanggal_mulai ? date('Y-m-d', strtotime($tahapan->tanggal_mulai)) : '' }}">
                </div>

                <div class="mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                        value="{{ $tahapan->tanggal_selesai ? date('Y-m-d', strtotime($tahapan->tanggal_selesai)) : '' }}">
                </div>

                <button class="btn btn-primary">Update</button>
                <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection
