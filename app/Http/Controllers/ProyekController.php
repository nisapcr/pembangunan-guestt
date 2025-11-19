<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProyekController extends Controller
{
    /**
     * Menampilkan daftar semua proyek.
     */
    public function index()
    {
        $proyek = Proyek::all();
        return view('pages.proyek.index', compact('proyek'));
    }

    /**
     * Menampilkan formulir untuk membuat proyek baru.
     */
    public function create()
    {
        return view('pages.proyek.create', [
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
            'dokumen' => 'nullable|file|max:2048' // Max 2MB
        ]);

        // Handle upload file dokumen
        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen-proyek', 'public');
            $validated['dokumen'] = $path;
        }

        Proyek::create($validated);

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    /**
     * Menampilkan detail proyek tertentu.
     */
    public function show(Proyek $proyek)
    {
        return view('pages.proyek.show', [
            'proyek' => $proyek,
            'title' => 'Detail Proyek'
        ]);
    }

    /**
     * Menampilkan formulir untuk mengedit proyek.
     */
    public function edit(Proyek $proyek)
    {
        return view('pages.proyek.edit', [
            'proyek' => $proyek,
            'title' => 'Edit Proyek'
        ]);
    }

    /**
     * Memperbarui proyek di database.
     */
    public function update(Request $request, Proyek $proyek)
    {
        // Validasi data input untuk update
        $validated = $request->validate([
            'kode_proyek' => 'required|unique:proyek,kode_proyek,' . $proyek->proyek_id . ',proyek_id',
            'nama_proyek' => 'required',
            'tahun' => 'required|integer',
            'lokasi' => 'required',
            'anggaran' => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi' => 'nullable',
            'dokumen' => 'nullable|file|max:2048'
        ]);

        // Handle upload file dokumen jika ada file baru
        if ($request->hasFile('dokumen')) {
            // Hapus file lama jika ada
            if ($proyek->dokumen && Storage::disk('public')->exists($proyek->dokumen)) {
                Storage::disk('public')->delete($proyek->dokumen);
            }

            $path = $request->file('dokumen')->store('dokumen-proyek', 'public');
            $validated['dokumen'] = $path;
        } else {
            // Jika tidak ada file baru, pertahankan file lama
            $validated['dokumen'] = $proyek->dokumen;
        }

        $proyek->update($validated);

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil diperbarui');
    }

    /**
     * Menghapus proyek dari database.
     */
    public function destroy(Proyek $proyek)
    {
        // Hapus file dokumen jika ada
        if ($proyek->dokumen && Storage::disk('public')->exists($proyek->dokumen)) {
            Storage::disk('public')->delete($proyek->dokumen);
        }

        $proyek->delete();

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil dihapus');
    }

    // --- METHOD KUSTOM YANG ADA DI ROUTE ANDA ---

    public function tahapan()
    {
        return view('pages.tahapan', ['title' => 'Tahapan Proyek']);
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

    /**
     * Method untuk halaman contact.
     */
    public function contact()
    {
        return view('pages.contact', ['title' => 'Hubungi Kami']);
    }

    /**
     * Method untuk halaman tentang kami.
     */
    public function tentang()
    {
        return view('pages.tentang', ['title' => 'Tentang Kami']);
    }
}
