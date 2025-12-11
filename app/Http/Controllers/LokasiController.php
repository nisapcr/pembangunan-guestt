<?php

namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Halaman peta lokasi proyek
     */
    public function peta()
    {
        $lokasis = LokasiProyek::with('proyek')->get();
        return view('lokasi.peta', compact('lokasis'));
    }

    /**
     * API untuk data peta (JSON)
     */
    public function getMapData()
    {
        $lokasis = LokasiProyek::with('proyek')->get();

        $data = $lokasis->map(function ($lokasi) {
            return [
                'id' => $lokasi->id,
                'nama_lokasi' => $lokasi->nama_lokasi,
                'alamat' => $lokasi->alamat,
                'lat' => (float) $lokasi->lat,
                'lng' => (float) $lokasi->lng,
                'proyek' => $lokasi->proyek ? $lokasi->proyek->nama_proyek : 'Tidak ada proyek',
                'status_proyek' => $lokasi->proyek ? $lokasi->proyek->status : null,
                'detail_url' => url('/lokasi-proyek/' . $lokasi->id),
                'denah_gambar' => $lokasi->denah_gambar ? asset('storage/' . $lokasi->denah_gambar) : null,
                'keterangan' => $lokasi->keterangan,
            ];
        });

        return response()->json($data);
    }
}
