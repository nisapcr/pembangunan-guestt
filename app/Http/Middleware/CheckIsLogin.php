<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()
                ->route('auth.index')    // ➜ Sesuaikan dengan route login modul kamu
                ->withErrors('Silahkan login terlebih dahulu!');
        }

        return $next($request);
    }
}
