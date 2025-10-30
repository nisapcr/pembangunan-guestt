<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index() {
        return view('pages.proyek', ['title' => 'Daftar Proyek']);
    }

    public function tahapan() {
        return view('pages.tahapan', ['title' => 'Tahapan Proyek']);
    }

    public function progres() {
        return view('pages.progres', ['title' => 'Progres Proyek']);
    }

    public function lokasi() {
        return view('pages.lokasi', ['title' => 'Lokasi Proyek']);
    }

    public function kontraktor() {
        return view('pages.kontraktor', ['title' => 'Kontraktor']);
    }

    public function contact() {
        return view('pages.contact', ['title' => 'Kontak Kami']);
    }

    
}
     