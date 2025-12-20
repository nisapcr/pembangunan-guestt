<?php

namespace Database\Seeders;

use App\Models\LokasiProyek;
use App\Models\Proyek;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LokasiProyekSeeder extends Seeder
{
    public function run()
    {
        // Ambil data proyek
$proyeks = DB::table('proyeks')->get();
        if ($proyeks->isEmpty()) {
            $this->command->info('⚠️  Tidak ada data proyek. Skipping seeder lokasi proyek.');
            return;
        }

        // Lokasi-lokasi umum di Indonesia dengan koordinat valid
        $lokasiIndonesia = [
            ['lat' => -6.2088, 'lng' => 106.8456, 'city' => 'Jakarta'],
            ['lat' => -6.9175, 'lng' => 107.6191, 'city' => 'Bandung'],
            ['lat' => -7.7956, 'lng' => 110.3695, 'city' => 'Yogyakarta'],
            ['lat' => -6.9667, 'lng' => 110.4167, 'city' => 'Semarang'],
            ['lat' => -7.2504, 'lng' => 112.7688, 'city' => 'Surabaya'],
            ['lat' => -8.6705, 'lng' => 115.2126, 'city' => 'Denpasar'],
            ['lat' => -5.1477, 'lng' => 119.4327, 'city' => 'Makassar'],
            ['lat' => -0.0263, 'lng' => 109.3425, 'city' => 'Pontianak'],
            ['lat' => 1.5493, 'lng' => 124.8479, 'city' => 'Manado'],
            ['lat' => -3.3199, 'lng' => 114.5908, 'city' => 'Banjarmasin'],
        ];

        // Contoh denah gambar (nama file dummy)
        $denahGambar = [
            'denah_proyek_1.jpg',
            'denah_proyek_2.png',
            'denah_site_plan.jpg',
            'denah_lokasi.png',
            null,
            null,
        ];

        // Contoh GeoJSON data (sederhana)
        $geojsonSamples = [
            null,
            null,
            [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [106.8456, -6.2088]
                ],
                'properties' => [
                    'name' => 'Lokasi Proyek',
                    'description' => 'Titik utama proyek'
                ]
            ],
            [
                'type' => 'FeatureCollection',
                'features' => [
                    [
                        'type' => 'Feature',
                        'geometry' => [
                            'type' => 'Polygon',
                            'coordinates' => [[
                                [106.845, -6.209],
                                [106.846, -6.209],
                                [106.846, -6.208],
                                [106.845, -6.208],
                                [106.845, -6.209]
                            ]]
                        ],
                        'properties' => [
                            'name' => 'Area Proyek',
                            'area' => '1000 m²'
                        ]
                    ]
                ]
            ]
        ];

        // Contoh media tambahan (FIXED: field names)
        $mediaTambahanSamples = [
            null,
            null,
            [
                [
                    'filename' => 'site_photo_1.jpg',
                    'original_name' => 'foto_site_1.jpg',
                    'mime' => 'image/jpeg',
                    'size' => 204800,
                    'path' => 'lokasi_proyek/media/site_photo_1.jpg',
                    'uploaded_at' => now()->subDays(10)->toDateTimeString()
                ],
                [
                    'filename' => 'document_plan.pdf',
                    'original_name' => 'rencana_proyek.pdf',
                    'mime' => 'application/pdf',
                    'size' => 512000,
                    'path' => 'lokasi_proyek/media/document_plan.pdf',
                    'uploaded_at' => now()->subDays(5)->toDateTimeString()
                ]
            ],
            [
                [
                    'filename' => 'progress_report.docx',
                    'original_name' => 'laporan_progres.docx',
                    'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'size' => 153600,
                    'path' => 'lokasi_proyek/media/progress_report.docx',
                    'uploaded_at' => now()->subDays(3)->toDateTimeString()
                ]
            ]
        ];

        // Kosongkan tabel terlebih dahulu
        DB::table('lokasi_proyek')->truncate();

        $data = [];
        $counter = 1;

        foreach ($proyeks as $proyek) {
            // Setiap proyek bisa punya 1-4 lokasi
            $jumlahLokasi = rand(1, 4);

            for ($i = 1; $i <= $jumlahLokasi; $i++) {
                // Pilih lokasi random dari daftar
                $lokasiPilihan = $lokasiIndonesia[array_rand($lokasiIndonesia)];

                // Nama lokasi
                $namaLokasi = $this->generateNamaLokasi($proyek->nama_proyek, $i);

                // Alamat
                $alamat = "Jl. " . fake()->streetName() . " No. " . fake()->buildingNumber() . ", " . $lokasiPilihan['city'];

                // Generate koordinat dengan variasi kecil
                $lat = $lokasiPilihan['lat'] + (fake()->boolean() ? fake()->randomFloat(6, -0.01, 0) : fake()->randomFloat(6, 0, 0.01));
                $lng = $lokasiPilihan['lng'] + (fake()->boolean() ? fake()->randomFloat(6, -0.01, 0) : fake()->randomFloat(6, 0, 0.01));

                // GeoJSON (30% memiliki GeoJSON)
                $geojson = fake()->boolean(30) ? $geojsonSamples[array_rand($geojsonSamples)] : null;

                // Denah gambar (50% memiliki denah)
                $denah = fake()->boolean(50) ? $denahGambar[array_rand($denahGambar)] : null;

                // Media tambahan (40% memiliki media tambahan)
                $mediaTambahan = fake()->boolean(40) ? $mediaTambahanSamples[array_rand($mediaTambahanSamples)] : null;

                $data[] = [
                    'proyek_id' => $proyek->proyek_id,
                    'nama_lokasi' => $namaLokasi,
                    'alamat' => $alamat,
                    'lat' => $lat,
                    'lng' => $lng,
                    'geojson' => $geojson ? json_encode($geojson, JSON_UNESCAPED_SLASHES) : null,
                    'denah_gambar' => $denah,
                    'media_tambahan' => $mediaTambahan ? json_encode($mediaTambahan, JSON_UNESCAPED_SLASHES) : null,
                    'created_at' => Carbon::now()->subDays(rand(1, 365)),
                    'updated_at' => Carbon::now(),
                ];

                $counter++;
            }
        }

        // Insert data ke database
        DB::table('lokasi_proyek')->insert($data);

        $this->command->info('✅ Seeder Lokasi Proyek berhasil dijalankan! ' . count($data) . ' data lokasi ditambahkan.');

        // Tampilkan statistik
        $stats = [
            'total' => count($data),
            'dengan_koordinat' => count($data),
            'dengan_geojson' => collect($data)->whereNotNull('geojson')->count(),
            'dengan_denah' => collect($data)->whereNotNull('denah_gambar')->count(),
            'dengan_media' => collect($data)->whereNotNull('media_tambahan')->count(),
        ];

        $this->command->info('📊 Statistik:');
        $this->command->info('   • Total lokasi: ' . $stats['total']);
        $this->command->info('   • Dengan koordinat: ' . $stats['dengan_koordinat'] . ' (' . round(($stats['dengan_koordinat'] / $stats['total']) * 100) . '%)');
        $this->command->info('   • Dengan GeoJSON: ' . $stats['dengan_geojson'] . ' (' . round(($stats['dengan_geojson'] / $stats['total']) * 100) . '%)');
        $this->command->info('   • Dengan denah gambar: ' . $stats['dengan_denah'] . ' (' . round(($stats['dengan_denah'] / $stats['total']) * 100) . '%)');
        $this->command->info('   • Dengan media tambahan: ' . $stats['dengan_media'] . ' (' . round(($stats['dengan_media'] / $stats['total']) * 100) . '%)');

        // Tampilkan contoh data
        $this->command->info("\n📋 Contoh data yang ditambahkan:");
        $this->command->info("=====================================");

        for ($i = 0; $i < min(3, count($data)); $i++) {
            $lokasi = $data[$i];
            $proyek = $proyeks->where('proyek_id', $lokasi['proyek_id'])->first();

            $this->command->info(($i + 1) . ". " . $lokasi['nama_lokasi']);
            $this->command->info("   Proyek: " . ($proyek->nama_proyek ?? 'N/A'));
            $this->command->info("   Alamat: " . substr($lokasi['alamat'], 0, 40) . "...");
            $this->command->info("   Koordinat: " . number_format($lokasi['lat'], 6) . ', ' . number_format($lokasi['lng'], 6));
            $this->command->info("   Denah: " . ($lokasi['denah_gambar'] ? '✓' : '✗'));
            $this->command->info("   GeoJSON: " . ($lokasi['geojson'] ? '✓' : '✗'));
            $this->command->info("   Media tambahan: " . ($lokasi['media_tambahan'] ? '✓ (' . count(json_decode($lokasi['media_tambahan'], true)) . ' file)' : '✗'));
            $this->command->info("   ---");
        }
    }

    private function generateNamaLokasi($proyekNama, $index)
    {
        $prefixes = ['Lokasi Utama', 'Site Office', 'Base Camp', 'Area Kerja', 'Zona Proyek', 'Titik Kerja'];
        $suffixes = ['A', 'B', 'C', 'D', 'E'];

        $prefix = $prefixes[($index - 1) % count($prefixes)];
        $suffix = $suffixes[($index - 1) % count($suffixes)];

        return $prefix . ' ' . $proyekNama . ' - ' . $suffix;
    }
}
