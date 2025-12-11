<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil role dari session atau dari database
        $role = session('user_role', $user->role ?? 'user');

        // Jika role masih kosong, set default
        if (empty($role)) {
            $role = 'pelanggan';
            $user->role = $role;
            $user->save();
            session(['user_role' => $role]);
        }

        // Tentukan pesan berdasarkan role
        $roleMessages = [
            'superadmin' => 'Super Administrator',
            'admin' => 'Administrator',
            'mitra' => 'Mitra',
            'pelanggan' => 'Pelanggan',
            'user' => 'User'
        ];

        $roleDisplay = $roleMessages[$role] ?? ucfirst($role);

        return view('pages.dashboard', [
            'user' => $user,
            'role' => $role,
            'roleDisplay' => $roleDisplay
        ]);
    }
}
