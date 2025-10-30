@extends('layouts.app')

@section('title', 'Daftar Proyek')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-20 rounded-b-3xl shadow-lg">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-extrabold mb-4">Daftar Proyek</h1>
            <p class="text-lg font-light">Membangun masa depan dengan inovasi, kualitas, dan kepercayaan.</p>
        </div>
    </section>

    <!-- Daftar Proyek -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto text-center mb-12">
            <h2 class="text-3xl font-bold text-blue-700 mb-3">Daftar Proyek</h2>
            <p class="text-gray-600">Berikut adalah proyek pembangunan yang sedang berlangsung.</p>
        </div>

        <div class="container mx-auto grid md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
            @forelse($proyek as $p)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="bg-blue-600 h-2"></div>
                    <div class="p-6 text-left">
                        <h3 class="text-xl font-bold text-blue-700 mb-2">{{ $p->nama_proyek }}</h3>
                        <p class="text-gray-600 mb-3 text-sm"><strong>Kode:</strong> {{ $p->kode_proyek }}</p>
                        <p class="text-gray-600 mb-3 text-sm"><strong>Tahun:</strong> {{ $p->tahun }}</p>
                        <p class="text-gray-600 mb-3 text-sm"><strong>Lokasi:</strong> {{ $p->lokasi }}</p>
                        <p class="text-gray-600 mb-3 text-sm"><strong>Anggaran:</strong> Rp{{ number_format($p->anggaran, 0, ',', '.') }}</p>
                        <p class="text-gray-600 mb-3 text-sm"><strong>Sumber Dana:</strong> {{ $p->sumber_dana }}</p>
                        <p class="text-gray-500 text-sm mb-4">{{ Str::limit($p->deskripsi, 100) }}</p>

                        @if($p->media)
                            <a href="{{ asset('storage/' . $p->media) }}" target="_blank"
                               class="inline-block text-blue-600 font-medium hover:underline">
                               📎 Lihat Dokumen
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">
                    Tidak ada proyek yang tersedia.
                </div>
            @endforelse
        </div>
    </section>
@endsection
