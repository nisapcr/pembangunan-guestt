<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Proyek Baru</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body { 
            background-color: #f4f7f6; 
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 900px; /* Lebar container lebih fokus */
        }
        .card { 
            border-radius: 15px; 
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background-color: #0d6efd; /* Warna primary Bootstrap (Biru) */
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.4rem;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.65rem 1rem;
        }
        .btn-submit {
            padding: 0.6rem 2rem;
            font-size: 1rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container py-5">
    
    <div class="mb-4">
        <a href="{{ route('proyek.index') }}" class="btn btn-link text-muted text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Proyek
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-folder-plus me-2"></i> Tambah Proyek Baru
        </div>
        <div class="card-body p-5">
            
            <!-- Pesan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('proyek.store') }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kode_proyek" class="form-label">Kode Proyek</label>
                            <input type="text" class="form-control" id="kode_proyek" name="kode_proyek" value="{{ old('kode_proyek') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_proyek" class="form-label">Nama Proyek</label>
                            <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{ old('nama_proyek') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" required min="2000" max="2100">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="anggaran" class="form-label">Anggaran (Rp)</label>
                            <input type="number" class="form-control" id="anggaran" name="anggaran" value="{{ old('anggaran') }}" step="0.01" required>
                            <div class="form-text">Masukkan nilai tanpa titik atau koma. Contoh: 1500000000</div>
                        </div>
                        <div class="mb-3">
                            <label for="sumber_dana" class="form-label">Sumber Dana</label>
                            <select class="form-select" id="sumber_dana" name="sumber_dana" required>
                                <option value="" disabled selected>Pilih Sumber Dana</option>
                                {{-- Contoh opsi, Anda bisa menyesuaikannya --}}
                                <option value="APBN" {{ old('sumber_dana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                                <option value="APBD" {{ old('sumber_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                                <option value="Hibah" {{ old('sumber_dana') == 'Hibah' ? 'selected' : '' }}>Hibah</option>
                                <option value="Swasta" {{ old('sumber_dana') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-submit shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Proyek
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
