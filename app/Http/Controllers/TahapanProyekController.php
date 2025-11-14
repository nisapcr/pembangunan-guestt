<?php

namespace App\Http\Controllers;

use App\Models\TahapanProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Http\Requests\TahapanStoreRequest;

class TahapanProyekController extends Controller
{
    public function index()
    {
        $tahapans = TahapanProyek::with('proyek')->latest()->get();
        return view('pages.tahapan.index', compact('tahapans'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        return view('pages.tahapan.create', compact('proyeks'));
    }

    public function store(TahapanStoreRequest $request)
    {
        TahapanProyek::create($request->validated());

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $proyeks = Proyek::all();

        return view('pages.tahapan.edit', compact('tahapan', 'proyeks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proyek_id'       => 'required|integer',
            'nama_tahapan'    => 'required|string',
            'target_persen'   => 'required|integer|min:0|max:100',
            'tanggal_mulai'       => 'nullable|date',
            'tanggal_selesai'     => 'nullable|date',
        ]);

        $tahapan = TahapanProyek::findOrFail($id);

        $tahapan->update([
            'proyek_id'     => $request->proyek_id,
            'nama_tahapan'  => $request->nama_tahapan,
            'target_persen' => $request->target_persen,
    'tanggal_mulai'     => $request->tanggal_mulai ?: null,
    'tanggal_selesai'   => $request->tanggal_selesai ?: null,

        ]);

        return redirect()
            ->route('tahapan.index')
            ->with('success', 'Tahapan berhasil diperbarui!');
    }
}
