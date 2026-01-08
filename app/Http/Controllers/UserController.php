<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user.
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = User::query();

        // SEARCH: Filter berdasarkan keyword pencarian
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('email', 'like', $searchTerm);
            });
        }

        // FILTER: Filter berdasarkan role
        if ($request->has('role') && !empty($request->role)) {
            $query->where('role', $request->role);
        }

        // SORTING: Urutkan berdasarkan kolom
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination dengan query string dan onEachSide
        $users = $query->paginate(10)
                      ->withQueryString()
                      ->onEachSide(2);

        return view('pages.user.index', compact('users'));
    }

    /**
     * Tampilkan form untuk menambah user baru.
     */
    public function create()
    {
        // SESUAIKAN DENGAN ENUM DI DATABASE
        $roles = [
    'admin'    => 'Administrator',
    'pelanggan'=> 'Pelanggan',
    'user'     => 'User Biasa'
];
        return view('pages.user.create', compact('roles'));
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // SESUAIKAN DENGAN ENUM DI DATABASE
            'role' => 'required|string|in:admin,pelanggan,user',

            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userData = [
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ];

        // Handle upload profile picture
        if ($request->hasFile('profile_picture')) {
            $imageName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $imagePath = $request->file('profile_picture')->storeAs('profile_pictures', $imageName, 'public');
            $userData['profile_picture'] = $imageName;
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail user tertentu.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Tampilkan form edit untuk user tertentu.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        // SESUAIKAN DENGAN ENUM DI DATABASE
        $roles = [
            'admin'    => 'Admin',
            'petugas'  => 'Petugas',
            'user'     => 'User'
        ];
        return view('pages.user.edit', compact('user', 'roles'));
    }

    /**
     * Update data user tertentu di database.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            // SESUAIKAN DENGAN ENUM DI DATABASE
            'role'     => 'required|string|in:admin,petugas,user',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'role'   => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        // Handle upload profile picture
        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($user->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $user->profile_picture)) {
                Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
            }

            $imageName = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $imagePath = $request->file('profile_picture')->storeAs('profile_pictures', $imageName, 'public');
            $data['profile_picture'] = $imageName;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus profile picture user
     */
    public function removePicture(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $user->profile_picture)) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
            $user->update(['profile_picture' => null]);

            return back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return back()->with('error', 'Foto profil tidak ditemukan.');
    }

    /**
     * Hapus user dari database.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Cegah user menghapus akun sendiri
        if (auth()->check() && auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        // Delete profile picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists('profile_pictures/' . $user->profile_picture)) {
            Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
