<?php

namespace App\Http\Controllers;

use App\Models\Kontraktor;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontraktorController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Kolom yang bisa dicari
            $searchableColumns = ['nama', 'penanggung_jawab', 'kontak', 'alamat'];

            // Query dengan pagination, search, dan filter
            $kontraktors = Kontraktor::with(['proyek'])
                        ->filter($request, [])
                        ->orderBy('nama', 'asc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString()
                        ->onEachSide(2);

            // Hitung statistik
            $totalKontraktor = Kontraktor::count();
            $proyekDenganKontraktor = Kontraktor::distinct('proyek_id')->count('proyek_id');

            // Ambil data untuk filter
            $proyeks = Proyek::all();

            return view('pages.kontraktor.index', compact(
                'kontraktors',
                'totalKontraktor',
                'proyekDenganKontraktor',
                'proyeks'
            ));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $proyeks = Proyek::all();
        return view('pages.kontraktor.create', compact('proyeks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proyek_id'         => 'required|exists:proyeks,proyek_id',
            'nama'              => 'required|string|max:100',
            'penanggung_jawab'  => 'required|string|max:100',
            'kontak'            => 'required|string|max:20',
            'alamat'            => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // Bersihkan format kontak
        $validated['kontak'] = preg_replace('/[^0-9+]/', '', $validated['kontak']);

        Kontraktor::create($validated);

        return redirect()->route('kontraktor.index')
            ->with('success', 'Kontraktor berhasil ditambahkan!');
    }

    public function show($id)
    {
        $kontraktor = Kontraktor::with(['proyek'])->findOrFail($id);
        return view('pages.kontraktor.show', compact('kontraktor'));
    }

    public function edit($id)
    {
        $kontraktor = Kontraktor::findOrFail($id);
        $proyeks = Proyek::all();

        return view('pages.kontraktor.edit', compact('kontraktor', 'proyeks'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'proyek_id'         => 'required|exists:proyek,proyek_id',
            'nama'              => 'required|string|max:100',
            'penanggung_jawab'  => 'required|string|max:100',
            'kontak'            => 'required|string|max:20',
            'alamat'            => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // Bersihkan format kontak
        $validated['kontak'] = preg_replace('/[^0-9+]/', '', $validated['kontak']);

        $kontraktor = Kontraktor::findOrFail($id);
        $kontraktor->update($validated);

        return redirect()->route('kontraktor.index')
            ->with('success', 'Kontraktor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kontraktor = Kontraktor::findOrFail($id);
        $kontraktor->delete();

        return redirect()->route('kontraktor.index')
            ->with('success', 'Kontraktor berhasil dihapus!');
    }

}
