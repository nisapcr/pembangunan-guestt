@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Warga</h2>
    <a href="{{ route('warga.create') }}" class="btn btn-primary">Tambah Warga</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pekerjaan</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warga as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->no_ktp }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $item->agama }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td>{{ $item->telp }}</td>
                        <td>
                            <a href="{{ route('warga.show', $item->warga_id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data warga?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
