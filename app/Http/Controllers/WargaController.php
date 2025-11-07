<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga.
     */
    public function index()
    {
        try {
            $warga = Warga::all();

            return view('pages.warga.index', compact('warga'));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form tambah data.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|size:16',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|max:20',
            'pekerjaan' => 'required|max:50',
            'telp' => 'required|max:15',
            'email' => 'nullable|email|max:100',
        ]);

        try {
            Warga::create($request->all());

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Tampilkan detail warga.
     */
    public function show($id)
    {
        try {
            $warga = Warga::findOrFail($id);
            return view('pages.warga.show', compact('warga'));
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Data warga tidak ditemukan!');
        }
    }

    /**
     * Tampilkan form edit data warga.
     */
    public function edit($id)
    {
        try {
            $warga = Warga::findOrFail($id);
            return view('pages.warga.edit', compact('warga'));
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Data warga tidak ditemukan!');
        }
    }

    /**
     * Proses update data warga.
     */
    public function update(Request $request, $id)
    {
        try {
            $warga = Warga::findOrFail($id);

            $request->validate([
                'no_ktp' => 'required|size:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
                'nama' => 'required|max:100',
                'jenis_kelamin' => 'required|in:L,P',
                'agama' => 'required|max:20',
                'pekerjaan' => 'required|max:50',
                'telp' => 'required|max:15',
                'email' => 'nullable|email|max:100',
            ]);

            $warga->update($request->all());

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil diupdate!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Hapus data warga.
     */
    public function destroy($id)
    {
        try {
            $warga = Warga::findOrFail($id);
            $warga->delete();

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}