<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proyek;
use App\Models\User;
use App\Models\Warga;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Set default role jika kosong
        if (empty($user->role)) {
            $user->role = 'pelanggan';
            $user->save();
        }

        // Map role ke nama yang lebih user-friendly
        $roleDisplay = [
            'admin' => 'Administrator',
            'petugas' => 'Petugas',
            'user' => 'Pengguna',
            'pelanggan' => 'Pelanggan'
        ];

        $currentRole = $user->role;
        $roleName = $roleDisplay[$currentRole] ?? ucfirst($currentRole);

        // Warna badge berdasarkan role
        $roleColors = [
            'admin' => 'danger',
            'petugas' => 'warning',
            'user' => 'primary',
        ];
        $roleColor = $roleColors[$currentRole] ?? 'secondary';

        // Hitung statistik proyek
        $totalProyek = Proyek::count();

        // Inisialisasi variabel
        $proyekPetugas = 0;
        $proyekAktif = 0;
        $proyekSelesai = 0;
        $totalAnggaran = 0;

        // Untuk petugas, hanya hitung proyek yang mereka tangani
        if($currentRole === 'petugas') {
            $proyekPetugas = Proyek::where('petugas_id', $user->id)->count();
            $proyekAktif = Proyek::where('petugas_id', $user->id)
                ->where('tahun', '>=', date('Y') - 1)->count();
            $proyekSelesai = Proyek::where('petugas_id', $user->id)
                ->where('tahun', '<', date('Y') - 1)->count();
            $totalAnggaran = Proyek::where('petugas_id', $user->id)->sum('anggaran');
        } else {
            $proyekAktif = Proyek::where('tahun', '>=', date('Y') - 1)->count();
            $proyekSelesai = Proyek::where('tahun', '<', date('Y') - 1)->count();
            $totalAnggaran = Proyek::sum('anggaran');
        }

        // Hitung statistik pengguna
        $totalUsers = User::count();
        $adminCount = User::whereIn('role', ['admin'])->count();
        $petugasCount = User::where('role', 'petugas')->count();
        $userCount = User::where('role', 'user')->count();

        // Hitung statistik warga
        $totalWarga = Warga::count();
        $wargaLaki = Warga::where('jenis_kelamin', 'L')->count();
        $wargaPerempuan = Warga::where('jenis_kelamin', 'P')->count();

        // Ambil proyek terbaru
        $recentProyekQuery = Proyek::query();

        if($currentRole === 'petugas') {
            $recentProyekQuery->where('petugas_id', $user->id);
        }

        $recentProyek = $recentProyekQuery->latest()->take(5)->get();

        return view('pages.dashboard', [
            'user' => $user,
            'role' => $currentRole,
            'roleDisplay' => $roleName,
            'roleColor' => $roleColor,
            'totalProyek' => $totalProyek,
            'proyekPetugas' => $proyekPetugas,
            'proyekAktif' => $proyekAktif,
            'proyekSelesai' => $proyekSelesai,
            'totalAnggaran' => $totalAnggaran,
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'petugasCount' => $petugasCount,
            'userCount' => $userCount,
            'totalWarga' => $totalWarga,
            'wargaLaki' => $wargaLaki,
            'wargaPerempuan' => $wargaPerempuan,
            'recentProyek' => $recentProyek
        ]);
    }
}
