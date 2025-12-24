@extends('layouts.guest.app')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>
                <div class="text-end">
                    <small class="text-muted">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary bg-gradient text-white">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Selamat datang, {{ Auth::user()->name }}!</h5>
                            <p class="mb-0 opacity-75">
                                <i class="fas fa-clock me-1"></i>
                                {{ now()->format('H:i') }} • Sistem Manajemen Proyek
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Display User Role Correctly -->
                    @php
                        // Map role ke nama yang lebih user-friendly
                        $roleDisplay = [
                            'admin' => 'Administrator',
                            'petugas' => 'Petugas',
                            'user' => 'Pengguna'
                        ];

                        $currentRole = Auth::user()->role;
                        $roleName = $roleDisplay[$currentRole] ?? ucfirst($currentRole);

                        // Warna badge berdasarkan role
                        $roleColors = [

                            'admin' => 'danger',
                            'petugas' => 'warning',
                            'user' => 'primary'
                        ];
                        $roleColor = $roleColors[$currentRole] ?? 'secondary';

                        // Hitung statistik proyek
                        $totalProyek = \App\Models\Proyek::count();

                        // Untuk petugas, hanya hitung proyek yang mereka tangani
                        if($currentRole === 'petugas') {
                            $proyekPetugas = \App\Models\Proyek::where('petugas_id', Auth::id())->count();
                            $proyekAktif = \App\Models\Proyek::where('petugas_id', Auth::id())
                                ->where('tahun', '>=', date('Y') - 1)->count();
                            $proyekSelesai = \App\Models\Proyek::where('petugas_id', Auth::id())
                                ->where('tahun', '<', date('Y') - 1)->count();
                            $totalAnggaran = \App\Models\Proyek::where('petugas_id', Auth::id())->sum('anggaran');
                        } else {
                            $proyekAktif = \App\Models\Proyek::where('tahun', '>=', date('Y') - 1)->count();
                            $proyekSelesai = \App\Models\Proyek::where('tahun', '<', date('Y') - 1)->count();
                            $totalAnggaran = \App\Models\Proyek::sum('anggaran');
                        }
                    @endphp

                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-user-tie fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Status Login</h6>
                                    <p class="text-muted mb-0">Role saat ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="badge bg-{{ $roleColor }} fs-5 px-4 py-2">
                                <i class="fas fa-user-shield me-2"></i>
                                {{ $roleName }}
                            </span>
                        </div>
                    </div>

                    <!-- Role-specific Messages -->
                    @if(in_array($currentRole, ['superadmin', 'admin']))
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-10">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-shield fa-2x text-danger"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="alert-heading mb-2">
                                    <i class="fas fa-crown me-2"></i>
                                    Akses Administrator Penuh
                                </h5>
                                <p class="mb-2">Anda memiliki hak akses penuh ke semua modul sistem:</p>
                                <ul class="mb-0">
                                    <li><i class="fas fa-check-circle text-danger me-2"></i> Manajemen Pengguna (User Management)</li>
                                    <li><i class="fas fa-check-circle text-danger me-2"></i> Manajemen Data Warga</li>
                                    <li><i class="fas fa-check-circle text-danger me-2"></i> Monitoring Seluruh Proyek</li>
                                    <li><i class="fas fa-check-circle text-danger me-2"></i> Laporan dan Analisis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @elseif($currentRole === 'petugas')
                    <div class="alert alert-warning border-0 bg-warning bg-opacity-10">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-tie fa-2x text-warning"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="alert-heading mb-2">
                                    <i class="fas fa-tasks me-2"></i>
                                    Akses Petugas
                                </h5>
                                <p class="mb-2">Anda memiliki akses sebagai petugas:</p>
                                <ul class="mb-0">
                                    <li><i class="fas fa-check-circle text-warning me-2"></i> Tambah Data Proyek</li>
                                    <li><i class="fas fa-check-circle text-warning me-2"></i> Edit Data Proyek</li>
                                    <li><i class="fas fa-check-circle text-warning me-2"></i> Hapus Data Proyek</li>
                                    <li><i class="fas fa-check-circle text-warning me-2"></i> Lihat Detail Proyek</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-primary border-0 bg-primary bg-opacity-10">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="alert-heading mb-2">
                                    <i class="fas fa-eye me-2"></i>
                                    Akses Pengguna
                                </h5>
                                <p class="mb-2">Anda memiliki akses sebagai pengguna:</p>
                                <ul class="mb-0">
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Lihat Detail Proyek</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Lihat Status Proyek</li>
                                    <li><i class="fas fa-check-circle text-primary me-2"></i> Monitoring Progress</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Quick Stats -->
                    <div class="row mt-4">
                        @if(in_array($currentRole, ['superadmin', 'admin']))
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-start border-3 border-danger h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-users fa-2x text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Total Pengguna</h6>
                                            <h3 class="mb-0">{{ \App\Models\User::count() }}</h3>
                                            <small class="text-muted">
                                                @php
                                                    $adminCount = \App\Models\User::whereIn('role', ['admin', 'superadmin'])->count();
                                                    $petugasCount = \App\Models\User::where('role', 'petugas')->count();
                                                    $userCount = \App\Models\User::where('role', 'user')->count();
                                                @endphp
                                                <i class="fas fa-user-shield me-1"></i>{{ $adminCount }} Admin •
                                                <i class="fas fa-user-tie me-1"></i>{{ $petugasCount }} Petugas
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-start border-3 border-info h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-users fa-2x text-info"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Total Warga</h6>
                                            <h3 class="mb-0">{{ \App\Models\Warga::count() ?? 0 }}</h3>
                                            <small class="text-muted">
                                                @php
                                                    // Asumsi ada kolom 'status' atau 'jenis_kelamin' di model Warga
                                                    $wargaLaki = \App\Models\Warga::where('jenis_kelamin', 'L')->count() ?? 0;
                                                    $wargaPerempuan = \App\Models\Warga::where('jenis_kelamin', 'P')->count() ?? 0;
                                                @endphp
                                                <i class="fas fa-male me-1"></i>{{ $wargaLaki }} L •
                                                <i class="fas fa-female me-1"></i>{{ $wargaPerempuan }} P
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-start border-3 border-success h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-project-diagram fa-2x text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">
                                                @if($currentRole === 'petugas')
                                                    Proyek Saya
                                                @else
                                                    Total Proyek
                                                @endif
                                            </h6>
                                            <h3 class="mb-0">
                                                @if($currentRole === 'petugas')
                                                    {{ $proyekPetugas ?? 0 }}
                                                @else
                                                    {{ $totalProyek }}
                                                @endif
                                            </h3>
                                            @if($totalProyek > 0)
                                                <small class="text-muted">
                                                    <i class="fas fa-chart-line me-1"></i>
                                                    {{ $proyekAktif }} Aktif
                                                    @if($currentRole === 'petugas' && isset($proyekPetugas) && $proyekPetugas > 0)
                                                        • {{ $proyekSelesai }} Selesai
                                                    @endif
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-start border-3 border-warning h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">
                                                @if($currentRole === 'petugas')
                                                    Anggaran Proyek Saya
                                                @else
                                                    Total Anggaran
                                                @endif
                                            </h6>
                                            <h4 class="mb-0">Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</h4>
                                            @if(($currentRole === 'petugas' && $proyekPetugas > 0) || ($currentRole !== 'petugas' && $totalProyek > 0))
                                                <small class="text-muted">
                                                    Rata-rata: Rp {{
                                                        number_format(
                                                            $currentRole === 'petugas' ?
                                                            ($proyekPetugas > 0 ? $totalAnggaran / $proyekPetugas : 0) :
                                                            ($totalProyek > 0 ? $totalAnggaran / $totalProyek : 0),
                                                            0, ',', '.')
                                                    }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border-start border-3 border-info h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-calendar-check fa-2x text-info"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Login Terakhir</h6>
                                            <h5 class="mb-0">
                                                @if(Auth::user()->last_login_at)
                                                    {{ Auth::user()->last_login_at->diffForHumans() }}
                                                @else
                                                    Pertama kali
                                                @endif
                                            </h5>
                                            <small class="text-muted">
                                                <i class="fas fa-sign-in-alt me-1"></i>
                                                Bergabung {{ Auth::user()->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Proyek -->
                    @if($totalProyek > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-history me-2"></i>
                                        @if($currentRole === 'petugas')
                                            Proyek Terbaru Saya
                                        @else
                                            Proyek Terbaru
                                        @endif
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama Proyek</th>
                                                    <th>Lokasi</th>
                                                    <th>Tahun</th>
                                                    <th>Anggaran</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Query berdasarkan role
                                                    $recentProyekQuery = \App\Models\Proyek::query();

                                                    if($currentRole === 'petugas') {
                                                        $recentProyekQuery->where('petugas_id', Auth::id());
                                                    }

                                                    $recentProyek = $recentProyekQuery->latest()->take(5)->get();
                                                @endphp

                                                @foreach($recentProyek as $proyek)
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $proyek->kode_proyek }}</span>
                                                    </td>
                                                    <td>
                                                        <strong>{{ $proyek->nama_proyek }}</strong><br>
                                                        <small class="text-muted">{{ Str::limit($proyek->deskripsi, 50) }}</small>
                                                    </td>
                                                    <td>{{ $proyek->lokasi }}</td>
                                                    <td>{{ $proyek->tahun }}</td>
                                                    <td>Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $proyek->status_color ?? 'secondary' }}">
                                                            {{ $proyek->status ?? 'Belum Ditentukan' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('proyek.show', $proyek->proyek_id) }}"
                                                               class="btn btn-sm btn-info" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            @if(in_array($currentRole, ['superadmin', 'admin', 'petugas']))
                                                            <a href="{{ route('proyek.edit', $proyek->proyek_id) }}"
                                                               class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @endif

                                                            @if(in_array($currentRole, ['superadmin', 'admin']))
                                                            <form action="{{ route('proyek.destroy', $proyek->proyek_id) }}"
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-danger"
                                                                        title="Hapus"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @php
                                        $totalToShow = $currentRole === 'petugas' ? ($proyekPetugas ?? 0) : $totalProyek;
                                    @endphp

                                    @if($totalToShow > 5)
                                        <div class="text-center mt-2">
                                            <a href="{{ route('proyek.index') }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-list me-1"></i>
                                                Lihat Semua Proyek ({{ $totalToShow }})
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions based on Role -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-bolt me-2"></i>
                                        Aksi Cepat
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        @if(in_array($currentRole, ['superadmin', 'admin']))
                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('users.index') }}" class="btn btn-danger w-100">
                                                <i class="fas fa-users-cog me-2"></i> Kelola User
                                            </a>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('warga.index') }}" class="btn btn-info w-100">
                                                <i class="fas fa-users me-2"></i> Data Warga
                                            </a>
                                        </div>
                                        @endif

                                        @if(in_array($currentRole, ['superadmin', 'admin', 'petugas']))
                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('proyek.create') }}" class="btn btn-success w-100">
                                                <i class="fas fa-plus-circle me-2"></i> Tambah Proyek
                                            </a>
                                        </div>
                                        @endif

                                        <div class="col-md-3 col-sm-6">
                                            <a href="{{ route('proyek.index') }}" class="btn btn-primary w-100">
                                                <i class="fas fa-list me-2"></i>
                                                @if($currentRole === 'petugas')
                                                    Proyek Saya
                                                @else
                                                    Daftar Proyek
                                                @endif
                                            </a>
                                        </div>

                                        @if(in_array($currentRole, ['superadmin', 'admin']))
                                        <div class="col-md-3 col-sm-6">
                                            <a href="#" class="btn btn-warning w-100">
                                                <i class="fas fa-chart-bar me-2"></i> Laporan
                                            </a>
                                        </div>
                                        @endif
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
@endsection

@section('styles')
<style>
    .avatar-lg {
        width: 60px;
        height: 60px;
    }
    .card-header.bg-primary {
        background: linear-gradient(45deg, #0d6efd, #0a58ca);
    }
    .border-start {
        border-left-width: 4px !important;
    }
    .page-title-box {
        padding: 20px 0;
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .btn-group .btn {
        border-radius: 0.25rem !important;
        margin-right: 2px;
    }
    .btn-group .btn:first-child {
        border-top-left-radius: 0.25rem !important;
        border-bottom-left-radius: 0.25rem !important;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 0.25rem !important;
        border-bottom-right-radius: 0.25rem !important;
    }
</style>
@endsection

@section('scripts')
<script>
    // Konfirmasi sebelum menghapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
