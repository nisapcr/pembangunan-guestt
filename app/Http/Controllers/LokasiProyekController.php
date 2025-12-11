<?php

namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Query dengan filter
        $query = LokasiProyek::query();

        // Eager load proyek jika ada relasi
        if (method_exists(LokasiProyek::class, 'proyek')) {
            $query->with('proyek');
        }

        // Filter pencarian
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_lokasi', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');

                // Cek jika ada relasi proyek
                if (method_exists(LokasiProyek::class, 'proyek')) {
                    $q->orWhereHas('proyek', function($q2) use ($search) {
                        $q2->where('nama_proyek', 'like', '%' . $search . '%');
                    });
                }
            });
        }

        // Filter proyek
        if (request('proyek_id')) {
            $query->where('proyek_id', request('proyek_id'));
        }

        // Pagination
        $lokasis = $query->latest()->paginate(10);

        // Data untuk filter dropdown
        $proyeks = Proyek::all();

        // Statistik - PERBAIKAN UTAMA DI SINI
        $totalLokasi = LokasiProyek::count();

        // Hitung lokasi aktif dengan cara yang aman
        $lokasiAktif = 0;
        if (method_exists(LokasiProyek::class, 'proyek')) {
            try {
                $lokasiAktif = LokasiProyek::whereHas('proyek', function($q) {
                    $q->where('status', 'aktif');
                })->count();
            } catch (\Exception $e) {
                // Fallback jika ada error
                $lokasiAktif = LokasiProyek::count();
            }
        } else {
            $lokasiAktif = LokasiProyek::count();
        }

        return view('lokasi-proyek.index', compact('lokasis', 'proyeks', 'totalLokasi', 'lokasiAktif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyeks = Proyek::all();
        return view('lokasi-proyek.create', compact('proyeks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'proyek_id' => 'required|exists:proyeks,id',
            'alamat' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'denah_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar jika ada
        $data = $request->except('denah_gambar');

        if ($request->hasFile('denah_gambar')) {
            $path = $request->file('denah_gambar')->store('public/lokasi-denah');
            $data['denah_gambar'] = str_replace('public/', '', $path);
        }

        // Simpan data
        LokasiProyek::create($data);

        return redirect()->route('lokasi-proyek.index')
            ->with('success', 'Lokasi proyek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        // Load relasi jika ada
        if (method_exists($lokasi, 'proyek')) {
            $lokasi->load('proyek');
        }

        return view('lokasi-proyek.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lokasi = LokasiProyek::findOrFail($id);
        $proyeks = Proyek::all();
        return view('lokasi-proyek.edit', compact('lokasi', 'proyeks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        // Validasi
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'proyek_id' => 'required|exists:proyeks,id',
            'alamat' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'denah_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data
        $data = $request->except('denah_gambar');

        // Upload gambar baru jika ada
        if ($request->hasFile('denah_gambar')) {
            // Hapus gambar lama
            if ($lokasi->denah_gambar) {
                Storage::delete('public/' . $lokasi->denah_gambar);
            }

            // Upload gambar baru
            $path = $request->file('denah_gambar')->store('public/lokasi-denah');
            $data['denah_gambar'] = str_replace('public/', '', $path);
        }

        $lokasi->update($data);

        return redirect()->route('lokasi-proyek.index')
            ->with('success', 'Lokasi proyek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        // Hapus gambar jika ada
        if ($lokasi->denah_gambar) {
            Storage::delete('public/' . $lokasi->denah_gambar);
        }

        // Hapus data
        $lokasi->delete();

        return redirect()->route('lokasi-proyek.index')
            ->with('success', 'Lokasi proyek berhasil dihapus.');
    }
}
