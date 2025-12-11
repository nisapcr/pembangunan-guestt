<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.index')
                ->withErrors('Silahkan login terlebih dahulu!');
        }

        $user = Auth::user();

        // Hanya set default jika role benar-benar NULL atau empty
        if (empty($user->role) || trim($user->role) === '') {
            $user->role = 'pelanggan';
            $user->save();

            // Set session untuk menampilkan role yang benar
            session(['user_role' => 'pelanggan']);
        } else {
            // Simpan role ke session untuk tampilan
            session(['user_role' => $user->role]);
        }

        // Debug: Pastikan role yang terbaca benar
        // \Log::info('User Role: ' . $user->role . ', Required Role: ' . $role);

        // OPSI 1: IZINKAN SEMUA UNTUK TESTING (HAPUS BARIS INI SETELAH TESTING!)
        // return $next($request);

        // OPSI 2: FORCE JADI SUPERADMIN UNTUK USER TERTENTU
        if ($user->email === 'harnisa@gmail.com' && $user->role !== 'superadmin') {
            $user->role = 'superadmin';
            $user->save();
            session(['user_role' => 'superadmin']);
        }

        // Cek apakah role sesuai
        if ($user->role === $role) {
            return $next($request);
        }

        // Fallback: Jika role tidak cocok, coba cek berdasarkan email
        if ($user->email === 'admin@gmail.com' && $role === 'superadmin') {
            // Update role jika ternyata admin
            $user->role = 'superadmin';
            $user->save();
            session(['user_role' => 'superadmin']);
            return $next($request);
        }

        // Kembalikan 403 tanpa view khusus
        return abort(403, 'Akses ditolak. Role Anda: ' . ($user->role ?: 'TIDAK DIKETAHUI') . '. Diperlukan role: ' . $role);
    }
}
