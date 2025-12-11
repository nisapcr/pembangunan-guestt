<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TahapanProyekSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Ambil proyek_id dari tabel proyek
        $proyekIds = DB::table('proyeks')->pluck('proyek_id');

        if ($proyekIds->isEmpty()) {
            $this->command->error('Tidak ada data proyek! Jalankan ProyekSeeder terlebih dahulu.');
            return;
        }

        $tahapanList = [
            'Perencanaan Awal',
            'Studi Kelayakan',
            'Analisis Kebutuhan',
            'Penyusunan RAB',
            'Persiapan Dokumen',
            'Pengadaan Material',
            'Pekerjaan Persiapan',
            'Pekerjaan Struktur',
            'Pekerjaan Arsitektur',
            'Pekerjaan Mekanikal',
            'Pekerjaan Elektrikal',
            'Pekerjaan Finishing',
            'Pengawasan Kualitas',
            'Pengawasan Jadwal',
            'Uji Coba Sistem',
            'Serah Terima Pertama',
            'Pelatihan Pengguna',
            'Pemeliharaan Awal',
            'Garansi Proyek',
            'Evaluasi Akhir'
        ];

        // Kosongkan tabel terlebih dahulu
        DB::table('tahapan_proyek')->truncate();

        $data = [];
        $totalDataNeeded = 100;
        $dataCount = 0;

        foreach ($proyekIds as $proyekId) {
            // Untuk setiap proyek, buat 2-5 tahapan
            $jumlahTahapan = rand(2, 5);

            // Acak urutan tahapan yang akan digunakan
            $shuffledTahapan = $faker->randomElements($tahapanList, $jumlahTahapan);

            // Tanggal mulai proyek (random dalam 1 tahun terakhir)
            $proyekStartDate = $faker->dateTimeBetween('-1 year', 'now');
            $currentStartDate = clone $proyekStartDate;

            for ($i = 0; $i < $jumlahTahapan; $i++) {
                // Jika sudah mencapai 100 data, berhenti
                if ($dataCount >= $totalDataNeeded) {
                    break 2; // Keluar dari kedua loop
                }

                // Tentukan durasi tahapan (15-60 hari)
                $duration = rand(15, 60);

                // Untuk tahapan pertama, gunakan tanggal mulai proyek
                if ($i === 0) {
                    $tanggalMulai = clone $currentStartDate;
                } else {
                    // Untuk tahapan selanjutnya, mulai dari tanggal selesai tahapan sebelumnya + 1-7 hari
                    $gapDays = rand(1, 7);
                    $tanggalMulai = clone $currentStartDate;
                    $tanggalMulai->modify("+{$gapDays} days");
                }

                // Tanggal selesai = tanggal mulai + durasi
                $tanggalSelesai = clone $tanggalMulai;
                $tanggalSelesai->modify("+{$duration} days");

                // Update currentStartDate untuk tahapan berikutnya
                $currentStartDate = clone $tanggalSelesai;

                // Tentukan status berdasarkan tanggal
                $now = new \DateTime();
                $status = 'pending';

                if ($tanggalMulai <= $now && $tanggalSelesai >= $now) {
                    $status = 'in_progress';
                } elseif ($tanggalSelesai < $now) {
                    $status = 'completed';
                }

                // Tentukan target persen berdasarkan status
                $targetPersen = 0;
                if ($status === 'in_progress') {
                    $targetPersen = $faker->numberBetween(10, 90);
                } elseif ($status === 'completed') {
                    $targetPersen = 100;
                }

                $data[] = [
                    'proyek_id' => $proyekId, // Sesuai dengan kolom di tahapan_proyek
                    'nama_tahapan' => $shuffledTahapan[$i],
                    'deskripsi' => $this->generateDeskripsi($shuffledTahapan[$i], $faker),
                    'target_persen' => $targetPersen,
                    'tanggal_mulai' => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                    'status' => $status,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $dataCount++;
            }
        }

        // Jika belum mencapai 100 data, tambahkan data tambahan
        if ($dataCount < $totalDataNeeded) {
            $remaining = $totalDataNeeded - $dataCount;
            $this->command->info("Menambahkan {$remaining} data tambahan...");

            for ($i = 0; $i < $remaining; $i++) {
                $proyekId = $faker->randomElement($proyekIds->toArray());
                $tahapan = $faker->randomElement($tahapanList);

                $tanggalMulai = $faker->dateTimeBetween('-1 year', '+6 months');
                $duration = rand(15, 90);
                $tanggalSelesai = clone $tanggalMulai;
                $tanggalSelesai->modify("+{$duration} days");

                $now = new \DateTime();
                $status = 'pending';

                if ($tanggalMulai <= $now && $tanggalSelesai >= $now) {
                    $status = 'in_progress';
                } elseif ($tanggalSelesai < $now) {
                    $status = 'completed';
                }

                $targetPersen = 0;
                if ($status === 'in_progress') {
                    $targetPersen = $faker->numberBetween(10, 90);
                } elseif ($status === 'completed') {
                    $targetPersen = 100;
                }

                $data[] = [
                    'proyek_id' => $proyekId, // Sesuai dengan kolom di tahapan_proyek
                    'nama_tahapan' => $tahapan,
                    'deskripsi' => $this->generateDeskripsi($tahapan, $faker),
                    'target_persen' => $targetPersen,
                    'tanggal_mulai' => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                    'status' => $status,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                $dataCount++;
            }
        }

        // Insert data ke tabel
        DB::table('tahapan_proyek')->insert($data);

        $this->command->info('Seeder Tahapan Proyek berhasil! ' . count($data) . ' data ditambahkan.');
    }

    private function generateDeskripsi($namaTahapan, $faker)
    {
        $deskripsiMap = [
            'Perencanaan Awal' => 'Tahap perencanaan awal proyek termasuk identifikasi kebutuhan dan tujuan proyek',
            'Studi Kelayakan' => 'Analisis kelayakan teknis dan finansial proyek',
            'Analisis Kebutuhan' => 'Identifikasi dan dokumentasi kebutuhan detail proyek',
            'Penyusunan RAB' => 'Penyusunan Rencana Anggaran Biaya proyek',
            'Persiapan Dokumen' => 'Penyiapan dokumen tender dan administrasi proyek',
            'Pengadaan Material' => 'Proses pengadaan material dan peralatan proyek',
            'Pekerjaan Persiapan' => 'Pekerjaan persiapan lokasi dan pembangunan site office',
            'Pekerjaan Struktur' => 'Pekerjaan struktur bangunan termasuk pondasi dan rangka',
            'Pekerjaan Arsitektur' => 'Pekerjaan arsitektural dan desain bangunan',
            'Pekerjaan Mekanikal' => 'Instalasi sistem mekanikal dan plumbing',
            'Pekerjaan Elektrikal' => 'Instalasi sistem elektrikal dan penerangan',
            'Pekerjaan Finishing' => 'Pekerjaan finishing dan pengecatan',
            'Pengawasan Kualitas' => 'Monitoring dan pengendalian kualitas pekerjaan',
            'Pengawasan Jadwal' => 'Pengawasan terhadap kemajuan jadwal proyek',
            'Uji Coba Sistem' => 'Testing dan commissioning sistem yang terpasang',
            'Serah Terima Pertama' => 'Proses serah terima pekerjaan pertama',
            'Pelatihan Pengguna' => 'Pelatihan penggunaan fasilitas bagi pengguna',
            'Pemeliharaan Awal' => 'Pemeliharaan selama masa awal operasional',
            'Garansi Proyek' => 'Masa garansi dan tanggung jawab kontraktor',
            'Evaluasi Akhir' => 'Evaluasi keseluruhan kinerja proyek'
        ];

        return $deskripsiMap[$namaTahapan] ?? 'Deskripsi tahapan ' . $namaTahapan . ' untuk proyek ini';
    }
}
