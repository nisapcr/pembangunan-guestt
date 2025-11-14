<!DOCTYPE html>
<html>
<head>
    <title>Detail Proyek</title>
</head>
<body>
    <h1>Detail Proyek: {{ $proyek->nama_proyek }}</h1>

    <a href="{{ route('proyek.index') }}">Kembali ke Daftar Proyek</a>
    <br><br>

    <div>
        <strong>Kode Proyek:</strong> {{ $proyek->kode_proyek }}
    </div>
    <div>
        <strong>Nama Proyek:</strong> {{ $proyek->nama_proyek }}
    </div>
    <div>
        <strong>Tahun:</strong> {{ $proyek->tahun }}
    </div>
    <div>
        <strong>Lokasi:</strong> {{ $proyek->lokasi }}
    </div>
    <div>
        <strong>Anggaran:</strong> Rp{{ number_format($proyek->anggaran, 2, ',', '.') }}
    </div>
    <div>
        <strong>Sumber Dana:</strong> {{ $proyek->sumber_dana }}
    </div>
    <div>
        <strong>Deskripsi:</strong> {{ $proyek->deskripsi ?? '-' }}
    </div>
    <br>
    <a href="{{ route('proyek.edit', $proyek->proyek_id) }}">Edit Proyek</a>
</body>
</html>
