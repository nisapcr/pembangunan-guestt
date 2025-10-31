<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        return view('warga.index', compact('warga'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|size:16',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|max:20',
            'pekerjaan' => 'required|max:50',
            'telp' => 'required|max:15',
            'email' => 'nullable|email|max:100'
        ]);

        try {
            // Simpan data
            Warga::create([
                'no_ktp' => $request->no_ktp,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'telp' => $request->telp,
                'email' => $request->email
            ]);

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambah data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        try {
            $warga = Warga::findOrFail($id);
            return view('warga.show', compact('warga'));
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Data warga tidak ditemukan!');
        }
    }

    public function edit($id)
    {
        try {
            $warga = Warga::findOrFail($id);
            return view('warga.edit', compact('warga'));
        } catch (\Exception $e) {
            return redirect()->route('warga.index')
                ->with('error', 'Data warga tidak ditemukan!');
        }
    }

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
                'email' => 'nullable|email|max:100'
            ]);

            $warga->update([
                'no_ktp' => $request->no_ktp,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'telp' => $request->telp,
                'email' => $request->email
            ]);

            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage())
                ->withInput();
        }
    }

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