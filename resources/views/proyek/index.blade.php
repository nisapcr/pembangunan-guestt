<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-color: #f4f7f6; /* Warna latar belakang lebih lembut */
            font-family: 'Poppins', sans-serif; /* Asumsi font yang lebih modern */
        }
        .container {
            max-width: 1300px;
        }
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); /* Shadow lebih menonjol */
        }
        .header-section {
            background-color: #ffffff;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem 1.5rem 1rem 1.5rem;
            border-bottom: 1px solid #eee;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0 10px; /* Spasi antar baris lebih besar */
        }
        .table thead th {
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.8rem;
            border-bottom: 2px solid #e9ecef;
        }
        .table tbody tr {
            background-color: #ffffff;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .table tbody tr:hover {
            background-color: #f9f9fb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }
        .table td {
            border-top: none;
            border-bottom: none;
            vertical-align: middle;
            padding: 1rem 0.75rem;
        }
        .badge-info-custom {
            background-color: #e0f7fa !important;
            color: #00bcd4 !important;
            font-weight: bold;
        }
        .badge-success-custom {
            background-color: #e8f5e9 !important;
            color: #4caf50 !important;
            font-weight: bold;
        }
        .btn-action {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            margin-left: 3px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark mb-2">
            <i class="fas fa-hammer me-2 text-primary"></i> Monitoring Proyek
        </h2>
        <p class="text-muted">Kelola dan lihat data proyek pembangunan daerah</p>
    </div>

    <div class="card">
        <div class="header-section d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Proyek</h5>
            <!-- Tombol Tambah Proyek -->
            <a href="{{ route('proyek.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
                <i class="fas fa-plus me-1"></i> Proyek Baru
            </a>
        </div>

        <div class="card-body p-4">

            <!-- Filter/Search Bar (Tampilan Saja) -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control rounded-pill" placeholder="Cari berdasarkan Kode atau Nama Proyek...">
                </div>
                <div class="col-md-3">
                    <select class="form-select rounded-pill">
                        <option selected>Filter Tahun</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select rounded-pill">
                        <option selected>Filter Sumber Dana</option>
                        <option value="APBD">APBD</option>
                        <option value="APBN">APBN</option>
                    </select>
                </div>
            </div>

            <!-- Pesan Sesi (Success/Error) -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    <i class="fas fa-times-circle me-1"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">Kode Proyek</th>
                            <th>Nama Proyek</th>
                            <th>Tahun</th>
                            <th>Lokasi</th>
                            <th>Anggaran (Rp)</th>
                            <th>Sumber Dana</th>
                            <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyeks as $proyek)
                            <tr onclick="window.location='{{ route('proyek.show', $proyek->proyek_id) }}';" style="cursor: pointer;">
                                <td class="fw-bold ps-4 text-primary">{{ $proyek->kode_proyek }}</td>
                                <td class="text-wrap fw-medium">{{ $proyek->nama_proyek }}</td>
                                <td><span class="badge rounded-pill badge-info-custom">{{ $proyek->tahun }}</span></td>
                                <td>{{ $proyek->lokasi }}</td>
                                {{-- Memformat anggaran --}}
                                <td class="fw-semibold">{{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge rounded-pill badge-success-custom">{{ $proyek->sumber_dana }}</span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('proyek.destroy', $proyek->proyek_id) }}" method="POST" class="d-inline">
                                        {{-- Lihat (Show) - Menggunakan tombol terpisah lebih baik untuk mobile --}}
                                        <a href="{{ route('proyek.show', $proyek->proyek_id) }}" class="btn btn-sm btn-outline-primary btn-action" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('proyek.edit', $proyek->proyek_id) }}" class="btn btn-sm btn-outline-warning btn-action" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Hapus (Delete) --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-action" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek {{ $proyek->kode_proyek }}?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($proyeks->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="fas fa-exclamation-circle me-1"></i> Data proyek masih kosong. Silakan tambahkan proyek baru untuk memulai.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
