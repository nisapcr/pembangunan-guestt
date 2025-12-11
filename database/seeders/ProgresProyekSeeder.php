<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgresProyekSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Ambil data proyek dan tahapan
        $proyeks = DB::table('proyeks')->get();
        $tahapans = DB::table('tahapan_proyek')->get();

        if ($proyeks->isEmpty()) {
            $this->command->error('Tidak ada data proyek! Jalankan ProyekSeeder terlebih dahulu.');
            return;
        }

        if ($tahapans->isEmpty()) {
            $this->command->error('Tidak ada data tahapan! Jalankan TahapanProyekSeeder terlebih dahulu.');
            return;
        }

        // Catatan progress yang realisitis
        $catatanProgress = [
            // Progress baik
            'Progress berjalan sesuai rencana. Kualitas pekerjaan memuaskan.',
            'Pekerjaan sudah mencapai target yang ditetapkan. Semua material tersedia.',
            'Tidak ada kendala signifikan. Tim bekerja dengan baik dan disiplin.',
            'Cuaca mendukung sehingga progress bisa dipercepat.',
            'Material datang tepat waktu sehingga tidak ada delay.',
            'Tenaga kerja cukup dan berpengalaman.',
            'Koordinasi dengan pihak terkait berjalan lancar.',
            'Quality control berjalan dengan baik.',
            'Safety procedure dipatuhi dengan ketat.',
            'Progress melampaui target yang direncanakan.',

            // Progress dengan sedikit masalah
            'Ada sedikit keterlambatan karena hujan deras.',
            'Material utama mengalami delay pengiriman 2 hari.',
            'Perlu penambahan tenaga kerja untuk mengejar target.',
            'Ada penyesuaian desain minor yang mempengaruhi progress.',
            'Pemeriksaan quality menemukan beberapa area perlu perbaikan.',
            'Koordinasi dengan subcontractor perlu ditingkatkan.',
            'Perlu penambahan alat berat untuk pekerjaan tertentu.',
            'Ada perubahan jadwal dari owner.',
            'Progress sedikit melambat karena kondisi tanah.',
            'Perlu verifikasi ulang terhadap spesifikasi material.',

            // Progress dengan tantangan
            'Terjadi kendala teknis pada struktur utama.',
            'Material yang datang tidak sesuai spesifikasi.',
            'Tenaga kerja mengalami penurunan produktivitas.',
            'Cuaca buruk mengganggu progress selama 3 hari.',
            'Perlu redesign pada bagian tertentu.',
            'Ada masalah dengan izin lingkungan.',
            'Koordinasi antar disiplin perlu ditingkatkan.',
            'Budget constrain mempengaruhi progress.',
            'Perubahan scope kerja dari client.',
            'Equipment breakdown mengakibatkan delay.',

            // Progress hampir selesai
            'Pekerjaan sudah 95% selesai. Tinggal finishing.',
            'Hanya tersisa pekerjaan minor dan cleaning.',
            'Progress excellent. Siap untuk serah terima.',
            'Semua sistem sudah di-test dan berfungsi baik.',
            'Dokumentasi progress sudah lengkap.',
            'Final inspection sudah dilakukan.',
            'Punch list items sudah dikerjakan 80%.',
            'Training untuk user sudah dimulai.',
            'Persiapan untuk handover sudah 90%.',
            'Progress final mencapai 98%.',

            // Catatan tambahan untuk variasi
            'Site meeting dengan konsultan dilakukan pagi ini.',
            'Inspeksi dari dinas terkait berjalan lancar.',
            'Pengujian material laboratorium selesai.',
            'Perbaikan minor pada area basement.',
            'Progress lanjutan untuk pekerjaan atap.',
            'Instalasi sistem plumbing 70% selesai.',
            'Pengecatan eksterior tahap pertama selesai.',
            'Pemasangan kaca dan aluminium.',
            'Pekerjaan landscaping sedang berjalan.',
            'Pembersihan area kerja untuk pekerjaan berikutnya.',
            'Koordinasi dengan utility provider (PLN, PDAM).',
            'Safety briefing pagi dilakukan rutin.',
            'Material second delivery tiba di lokasi.',
            'Progress sesuai dengan baseline schedule.',
            'Weekly progress report sudah diserahkan.',
            'Meeting koordinasi dengan project manager.',
            'Quality audit internal menemukan beberapa NCR.',
            'Pekerjaan finishing interior dimulai.',
            'Testing sistem fire alarm berhasil.',
            'Final measurement untuk pekerjaan yang selesai.',
        ];

        // Kosongkan tabel terlebih dahulu
        DB::table('progres_proyek')->truncate();

        $data = [];
        $totalDataNeeded = 200; // Total progress yang ingin dibuat
        $dataCount = 0;

        // Untuk setiap proyek, buat beberapa progress
        foreach ($proyeks as $proyek) {
            // Ambil tahapan yang terkait dengan proyek ini
            $tahapansProyek = $tahapans->where('proyek_id', $proyek->proyek_id);

            if ($tahapansProyek->isEmpty()) {
                continue;
            }

            // Untuk setiap proyek, buat 2-5 progress
            $jumlahProgress = rand(2, 5);

            // Ambil random tahapan untuk progress ini
            $selectedTahapans = $tahapansProyek->random(min($jumlahProgress, $tahapansProyek->count()));

            foreach ($selectedTahapans as $tahapan) {
                // Jika sudah mencapai total data yang dibutuhkan, berhenti
                if ($dataCount >= $totalDataNeeded) {
                    break 2;
                }

                // Tentukan tanggal progress (antara tanggal_mulai dan tanggal_selesai tahapan)
                $tanggalMulai = Carbon::parse($tahapan->tanggal_mulai);
                $tanggalSelesai = Carbon::parse($tahapan->tanggal_selesai);

                // Pastikan tanggal_mulai <= tanggal_selesai
                if ($tanggalMulai->greaterThan($tanggalSelesai)) {
                    $tanggalProgress = $faker->dateTimeBetween($tanggalSelesai, $tanggalMulai);
                } else {
                    $tanggalProgress = $faker->dateTimeBetween($tanggalMulai, $tanggalSelesai);
                }

                // Tentukan persen_real berdasarkan status tahapan
                $persenReal = 0;
                $catatan = $this->generateRealisticCatatan($tahapan, $faker, $catatanProgress);

                switch ($tahapan->status) {
                    case 'pending':
                        // Untuk tahapan pending, progress biasanya 0-30%
                        $persenReal = $faker->numberBetween(0, 30);
                        break;

                    case 'in_progress':
                        // Untuk tahapan in_progress, progress bervariasi 10-90%
                        // Sesuaikan dengan target_persen tahapan
                        $target = $tahapan->target_persen;
                        if ($target > 0) {
                            // Progress real biasanya mendekati target, bisa sedikit di bawah atau di atas
                            $min = max(0, $target - 25);
                            $max = min(100, $target + 15);
                            $persenReal = $faker->numberBetween($min, $max);
                        } else {
                            $persenReal = $faker->numberBetween(10, 90);
                        }
                        break;

                    case 'completed':
                        // Untuk tahapan completed, progress harus 100%
                        $persenReal = 100;
                        break;
                }

                // Pastikan persen_real tidak melebihi 100
                $persenReal = min(100, $persenReal);

                // Tentukan apakah akan ada progress kedua (progress update)
                $willHaveSecondProgress = $faker->boolean(30) && $persenReal < 100;

                // Progress pertama
                $data[] = [
                    'proyek_id' => $proyek->proyek_id,
                    'tahap_id' => $tahapan->tahap_id,
                    'persen_real' => $persenReal,
                    'tanggal' => $tanggalProgress->format('Y-m-d'),
                    'catatan' => $catatan,
                    'foto_progres' => null, // TANPA FOTO
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $dataCount++;

                // Jika ada progress kedua (progress update)
                if ($willHaveSecondProgress && $dataCount < $totalDataNeeded) {
                    // Tanggal progress kedua (7-30 hari setelah progress pertama)
                    $daysLater = rand(7, 30);
                    $tanggalProgress2 = (clone $tanggalProgress)->modify("+{$daysLater} days");

                    // Pastikan tidak melebihi tanggal selesai tahapan
                    if ($tanggalProgress2 > $tanggalSelesai) {
                        $tanggalProgress2 = $tanggalSelesai;
                    }

                    // Progress kedua biasanya lebih tinggi
                    $persenReal2 = min(100, $persenReal + rand(10, 40));

                    // Catatan untuk progress update
                    $catatan2 = $this->generateUpdateCatatan($persenReal, $persenReal2, $tahapan, $faker, $catatanProgress);

                    $data[] = [
                        'proyek_id' => $proyek->proyek_id,
                        'tahap_id' => $tahapan->tahap_id,
                        'persen_real' => $persenReal2,
                        'tanggal' => $tanggalProgress2->format('Y-m-d'),
                        'catatan' => $catatan2,
                        'foto_progres' => null, // TANPA FOTO
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    $dataCount++;
                }

                // Untuk tahapan yang completed, tambahkan progress akhir 100%
                if ($tahapan->status === 'completed' && $persenReal < 100) {
                    if ($dataCount < $totalDataNeeded) {
                        $tanggalAkhir = $faker->dateTimeBetween(
                            $tanggalProgress->format('Y-m-d'),
                            $tanggalSelesai->format('Y-m-d')
                        );

                        $data[] = [
                            'proyek_id' => $proyek->proyek_id,
                            'tahap_id' => $tahapan->tahap_id,
                            'persen_real' => 100,
                            'tanggal' => $tanggalAkhir->format('Y-m-d'),
                            'catatan' => "✅ FINAL: Tahap " . strtolower($tahapan->nama_tahapan) . " telah 100% selesai sesuai dengan spesifikasi. Semua pekerjaan telah diverifikasi dan approved oleh konsultan pengawas.",
                            'foto_progres' => null, // TANPA FOTO
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];

                        $dataCount++;
                    }
                }
            }
        }

        // Jika belum mencapai total data yang dibutuhkan, tambahkan data random
        if ($dataCount < $totalDataNeeded) {
            $remaining = $totalDataNeeded - $dataCount;
            $this->command->info("Menambahkan {$remaining} data progress tambahan...");

            for ($i = 0; $i < $remaining; $i++) {
                $proyek = $faker->randomElement($proyeks->toArray());
                $tahapan = $faker->randomElement($tahapans->where('proyek_id', $proyek->proyek_id)->toArray());

                if (!$tahapan) {
                    // Jika proyek tidak punya tahapan, skip
                    continue;
                }

                // Tentukan tanggal progress
                $tanggalMulai = Carbon::parse($tahapan->tanggal_mulai);
                $tanggalSelesai = Carbon::parse($tahapan->tanggal_selesai);

                if ($tanggalMulai->greaterThan($tanggalSelesai)) {
                    $tanggalProgress = $faker->dateTimeBetween($tanggalSelesai, $tanggalMulai);
                } else {
                    $tanggalProgress = $faker->dateTimeBetween($tanggalMulai, $tanggalSelesai);
                }

                // Tentukan persen real
                $persenReal = match($tahapan->status) {
                    'pending' => $faker->numberBetween(0, 30),
                    'in_progress' => $faker->numberBetween(10, 90),
                    'completed' => $faker->boolean(80) ? 100 : $faker->numberBetween(95, 99),
                    default => $faker->numberBetween(0, 100)
                };

                // Generate catatan yang sesuai
                $catatan = $this->generateCatatanByProgress($persenReal, $tahapan, $faker, $catatanProgress);

                $data[] = [
                    'proyek_id' => $proyek->proyek_id,
                    'tahap_id' => $tahapan->tahap_id,
                    'persen_real' => $persenReal,
                    'tanggal' => $tanggalProgress->format('Y-m-d'),
                    'catatan' => $catatan,
                    'foto_progres' => null, // TANPA FOTO
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $dataCount++;
            }
        }

        // Insert data ke database
        DB::table('progres_proyek')->insert($data);

        $this->command->info('✅ Seeder Progress Proyek berhasil dijalankan! ' . count($data) . ' data progress ditambahkan.');
        $this->command->info('📊 Rata-rata progress: ' . number_format(collect($data)->avg('persen_real'), 1) . '%');

        // Hitung statistik per status
        $statusStats = [
            'pending' => 0,
            'in_progress' => 0,
            'completed' => 0
        ];

        foreach ($data as $progress) {
            if ($progress['persen_real'] <= 30) {
                $statusStats['pending']++;
            } elseif ($progress['persen_real'] < 100) {
                $statusStats['in_progress']++;
            } else {
                $statusStats['completed']++;
            }
        }

        $this->command->info('📈 Statistik Progress:');
        $this->command->info('   • Pending (0-30%): ' . $statusStats['pending'] . ' data');
        $this->command->info('   • In Progress (31-99%): ' . $statusStats['in_progress'] . ' data');
        $this->command->info('   • Completed (100%): ' . $statusStats['completed'] . ' data');

        // Tampilkan beberapa contoh data
        $this->command->info("\n📋 Contoh data progress yang ditambahkan:");
        $this->command->info("=====================================");

        for ($i = 0; $i < min(5, count($data)); $i++) {
            $progress = $data[$i];

            // Cari nama proyek dan tahapan
            $proyekNama = $proyeks->where('proyek_id', $progress['proyek_id'])->first()->nama_proyek ?? 'N/A';
            $tahapanNama = $tahapans->where('tahap_id', $progress['tahap_id'])->first()->nama_tahapan ?? 'N/A';

            $this->command->info(($i + 1) . ". " . $proyekNama);
            $this->command->info("   Tahapan: " . $tahapanNama);
            $this->command->info("   Progress: " . $progress['persen_real'] . "% pada " . $progress['tanggal']);
            $this->command->info("   Catatan: " . substr($progress['catatan'], 0, 50) . "...");
            $this->command->info("   ---");
        }

        $this->command->info("\n💡 Foto bisa ditambahkan manual melalui aplikasi.");
    }

    /**
     * Generate catatan yang realistis berdasarkan tahapan
     */
    private function generateRealisticCatatan($tahapan, $faker, $catatanProgress)
    {
        $baseCatatan = $faker->randomElement($catatanProgress);

        // Tambahkan prefix berdasarkan tahapan
        $prefixes = [
            'Progress ' . strtolower($tahapan->nama_tahapan) . ': ',
            'Update ' . strtolower($tahapan->nama_tahapan) . ': ',
            'Laporan ' . strtolower($tahapan->nama_tahapan) . ': ',
            'Catatan ' . strtolower($tahapan->nama_tahapan) . ': ',
        ];

        return $faker->randomElement($prefixes) . $baseCatatan;
    }

    /**
     * Generate catatan untuk progress update
     */
    private function generateUpdateCatatan($oldProgress, $newProgress, $tahapan, $faker, $catatanProgress)
    {
        $increase = $newProgress - $oldProgress;

        if ($increase > 0) {
            $increasePhrases = [
                "📈 Progress meningkat " . $increase . "% dari sebelumnya. ",
                "⬆️ Update positif: naik " . $increase . "% dari laporan sebelumnya. ",
                "✅ Perkembangan baik: bertambah " . $increase . "% dari progress terakhir. ",
                "🔺 Kemajuan: " . $increase . "% lebih tinggi dari update sebelumnya. ",
            ];

            $phrase = $faker->randomElement($increasePhrases);
        } else {
            $phrase = "📊 Update progress: " . $newProgress . "%. ";
        }

        return $phrase . $faker->randomElement($catatanProgress);
    }

    /**
     * Generate catatan berdasarkan persentase progress
     */
    private function generateCatatanByProgress($progress, $tahapan, $faker, $catatanProgress)
    {
        $prefix = '';

        if ($progress <= 30) {
            $prefixes = [
                "🚧 Persiapan awal " . strtolower($tahapan->nama_tahapan) . ": ",
                "📋 Setup pekerjaan " . strtolower($tahapan->nama_tahapan) . ": ",
                "🔧 Mulai pekerjaan " . strtolower($tahapan->nama_tahapan) . ": ",
            ];
            $prefix = $faker->randomElement($prefixes);
        } elseif ($progress <= 70) {
            $prefixes = [
                "⚡ Progress " . strtolower($tahapan->nama_tahapan) . " sedang berjalan: ",
                "🏗️ Pekerjaan " . strtolower($tahapan->nama_tahapan) . " dalam proses: ",
                "🔨 Tahap " . strtolower($tahapan->nama_tahapan) . " sedang dikerjakan: ",
            ];
            $prefix = $faker->randomElement($prefixes);
        } elseif ($progress < 100) {
            $prefixes = [
                "🎯 Menjelang akhir " . strtolower($tahapan->nama_tahapan) . ": ",
                "✨ Finalisasi " . strtolower($tahapan->nama_tahapan) . ": ",
                "🏁 Tahap akhir " . strtolower($tahapan->nama_tahapan) . ": ",
            ];
            $prefix = $faker->randomElement($prefixes);
        } else {
            $prefixes = [
                "✅ SELESAI: " . $tahapan->nama_tahapan . " telah selesai 100%. ",
                "🎉 COMPLETED: " . $tahapan->nama_tahapan . " sudah final. ",
                "✔️ FINISH: " . $tahapan->nama_tahapan . " sudah rampung. ",
            ];
            $prefix = $faker->randomElement($prefixes);
        }

        return $prefix . $faker->randomElement($catatanProgress);
    }
}
