<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Debug logging
        \Log::info('CheckRole middleware', [
            'user_id' => $user->id,
            'email' => $user->email,
            'current_role' => $user->role,
            'required_roles' => $roles
        ]);

        // Jika user tidak punya role, set default ke 'user'
        if (empty($user->role) || trim($user->role) === '') {
            $user->role = 'user';
            $user->save();
        }

        // Special case: force admin@gmail.com to be admin
        if ($user->email === 'admin@gmail.com' && $user->role !== 'admin') {
            $user->role = 'admin';
            $user->save();
        }

        // Cek apakah user memiliki salah satu role yang dibutuhkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // User tidak memiliki role yang dibutuhkan
        abort(403, 'Akses ditolak. Role Anda: ' . $user->role .
            '. Diperlukan salah satu role: ' . implode(', ', $roles));
    }
}
