<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules; // ✅ TAMBAHKAN INI
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function index()
    {
        return view('pages.login');
    }

    /**
     * Memproses login
     */
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Validasi wajib diisi
        if (empty($username) || empty($password)) {
            return redirect('/auth')->with('error', 'Username dan password wajib diisi');
        }

        // Validasi password minimal 3 karakter
        if (strlen($password) < 3) {
            return redirect('/auth')->with('error', 'Password harus minimal 3 karakter');
        }

        // Validasi password mengandung huruf kapital
        if (!preg_match('/[A-Z]/', $password)) {
            return redirect('/auth')->with('error', 'Password harus mengandung huruf kapital');
        }

        // Validasi username dan password sama
        if ($username === $password) {
            return view('login-berhasil')->with([
                'message' => 'Login berhasil!',
                'username' => $username
            ]);
        }

        return redirect('/auth')->with('error', 'Username dan password tidak sesuai');
    }

    public function showRegister()
    {
        return view('pages.register');
    }

    // proses registrasi
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('jenis.index');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index');
    }
}