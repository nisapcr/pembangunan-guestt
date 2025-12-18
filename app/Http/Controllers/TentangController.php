<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        return view('pages.tentang', [
            'title' => 'Tentang Kami',
            'description' => 'Sistem Manajemen Proyek Terpadu - PembangunanProyek'
        ]);
    }
}
