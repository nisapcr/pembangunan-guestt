<?php

namespace App\Http\Controllers;

use App\Models\Proyek; // Pastikan model Proyek di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Digunakan untuk logging jika diperlukan

class ProyekController extends Controller
{
    /**
     * Menampilkan daftar semua proyek (Ini dipanggil oleh rute '/' yang bernama 'home').
     */
    public function index()
    {
        $proyek = Proyek::all();
        return view('proyek.index', compact('proyek'));
    }

    /**
     * Menampilkan formulir untuk membuat proyek baru.
     */
    public function create()
    {
        return view('proyek.create', [
            'title' => 'Tambah Proyek Baru'
        ]);
    }

    /**
     * Menyimpan proyek baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'kode_proyek' => 'required|unique:proyek,kode_proyek',
            'nama_proyek' => 'required',
            'tahun' => 'required|integer',
            'lokasi' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi' => 'nullable',
            // Pastikan Anda menangani upload file dokumen di sini jika file diisi
            'dokumen' => 'nullable|file|max:2048' // Max 2MB
        ]);

        // Jika Anda ingin menangani upload file:
        // if ($request->hasFile('dokumen')) {
        //     $path = $request->file('dokumen')->store('dokumen-proyek', 'public');
        //     $validated['dokumen'] = $path;
        // }

        Proyek::create($validated);
        
        // --- PERBAIKAN PENTING DI BARIS INI ---
        // Mengubah redirect dari 'proyek.index' menjadi 'home', 
        // karena rute utama yang menampilkan index proyek diberi nama 'home'.
        return redirect()->route('home')->with('success', 'Proyek berhasil ditambahkan');
    }

    /**
     * Menampilkan detail proyek tertentu.
     */
    public function show(Proyek $proyek)
    {
        return view('proyek.show', [
            'proyek' => $proyek,
            'title' => 'Detail Proyek'
        ]);
    }

    /**
     * Menampilkan formulir untuk mengedit proyek.
     */
    public function edit(Proyek $proyek)
    {
        return view('proyek.edit', [
            'proyek' => $proyek,
            'title' => 'Edit Proyek'
        ]);
    }

    /**
     * Memperbarui proyek di database.
     */
    public function update(Request $request, Proyek $proyek)
    {
        // ... (Kode update dan validasi Anda di sini) ...
        
        // Contoh validasi dasar untuk update
        $validated = $request->validate([
            'nama_proyek' => 'required',
            'tahun' => 'required|integer',
            'lokasi' => 'required',
            // ... validasi lainnya
        ]);

        $proyek->update($validated);

        // Redirect ke detail proyek atau kembali ke halaman utama
        return redirect()->route('home')->with('success', 'Proyek berhasil diperbarui');
    }

    /**
     * Menghapus proyek dari database.
     */
    public function destroy(Proyek $proyek)
    {
        $proyek->delete();
        
        // Redirect kembali ke halaman utama
        return redirect()->route('home')->with('success', 'Proyek berhasil dihapus');
    }

    // --- METHOD KUSTOM YANG ADA DI ROUTE ANDA ---
    
    public function tahapan() 
    {
        return view('pages.tahapan', ['title' => 'TahapanProyek']);
    }

    public function progres() 
    {
        return view('pages.progres', ['title' => 'Progres Proyek']);
    }

    public function lokasi() 
    {
        return view('pages.lokasi', ['title' => 'Lokasi Proyek']);
    }

    public function kontraktor() 
    {
        return view('pages.kontraktor', ['title' => 'Daftar Kontraktor']);
    }


}