<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Daftar Proyek' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-700 mb-3">Daftar Proyek</h1>
            <p class="text-gray-600 mb-6">Berikut adalah proyek pembangunan yang sedang berlangsung.</p>
            <a href="{{ route('proyek.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-medium">
                + Tambah Proyek Baru
            </a>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($proyek as $p)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition duration-300">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-white font-bold text-lg truncate">{{ $p->nama_proyek }}</h3>
                        <span class="bg-white text-blue-600 text-xs font-bold px-2 py-1 rounded-full">
                            {{ $p->kode_proyek }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm">{{ $p->lokasi }}</span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 6l-2.5 1.5M12 14l2.5 1.5M12 14v1m0-1V7"/>
                            </svg>
                            <span class="text-sm">Tahun: {{ $p->tahun }}</span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 6l-2.5 1.5M12 14l2.5 1.5M12 14v1m0-1V7"/>
                            </svg>
                            <span class="text-sm">Sumber Dana: {{ $p->sumber_dana }}</span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 6l-2.5 1.5M12 14l2.5 1.5M12 14v1m0-1V7"/>
                            </svg>
                            <span class="text-sm font-semibold text-gray-800">
                                Rp {{ number_format($p->anggaran, 0, ',', '.') }}
                            </span>
                        </div>

                        @if($p->deskripsi)
                        <div class="text-gray-600 text-sm">
                            <p class="line-clamp-2">{{ Str::limit($p->deskripsi, 100) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer - Action Buttons -->
                <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('proyek.show', $p->proyek_id) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Detail
                        </a>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('proyek.edit', $p->proyek_id) }}" 
                               class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            
                            <form action="{{ route('proyek.destroy', $p->proyek_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center"
                                        onclick="return confirm('Yakin hapus proyek {{ $p->nama_proyek }}?')">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-12">
                <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada proyek</h3>
                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan proyek pertama Anda</p>
                    <a href="{{ route('proyek.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        + Tambah Proyek Pertama
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>