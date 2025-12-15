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

        // Ambil ID proyek (PK = id)
     $proyekIds = DB::table('proyeks')->pluck('proyek_id');


        if ($proyekIds->isEmpty()) {
            $this->command->error('❌ Tidak ada data proyek! Jalankan ProyekSeeder terlebih dahulu.');
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

        /**
         * ⚠️ PENTING
         * Jangan pakai truncate karena ada FK ke progres_proyek
         */
        DB::table('tahapan_proyek')->delete();

        $data = [];
        $totalTarget = 100;
        $counter = 0;

        foreach ($proyekIds as $proyekId) {

            $jumlahTahapan = rand(2, 5);
            $tahapanDipakai = $faker->randomElements($tahapanList, $jumlahTahapan);

            $tanggalMulaiProyek = $faker->dateTimeBetween('-1 year', 'now');
            $currentDate = clone $tanggalMulaiProyek;

            for ($i = 0; $i < $jumlahTahapan; $i++) {

                if ($counter >= $totalTarget) {
                    break 2;
                }

                $durasi = rand(15, 60);

                $tanggalMulai = clone $currentDate;
                $tanggalSelesai = (clone $tanggalMulai)->modify("+{$durasi} days");

                $currentDate = clone $tanggalSelesai;

                // Tentukan status
                $now = now();
                if ($tanggalMulai <= $now && $tanggalSelesai >= $now) {
                    $status = 'in_progress';
                } elseif ($tanggalSelesai < $now) {
                    $status = 'completed';
                } else {
                    $status = 'pending';
                }

                $targetPersen = match ($status) {
                    'completed' => 100,
                    'in_progress' => rand(10, 90),
                    default => 0
                };

                $data[] = [
                    'proyek_id'       => $proyekId,
                    'nama_tahapan'    => $tahapanDipakai[$i],
                    'target_persen'   => $targetPersen,
                    'tanggal_mulai'   => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                    'status'          => $status,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ];

                $counter++;
            }
        }

        // Jika belum sampai 100 data
        while ($counter < $totalTarget) {

            $proyekId = $faker->randomElement($proyekIds->toArray());
            $tanggalMulai = $faker->dateTimeBetween('-1 year', '+6 months');
            $durasi = rand(15, 90);
            $tanggalSelesai = (clone $tanggalMulai)->modify("+{$durasi} days");

            $now = now();
            if ($tanggalMulai <= $now && $tanggalSelesai >= $now) {
                $status = 'in_progress';
            } elseif ($tanggalSelesai < $now) {
                $status = 'completed';
            } else {
                $status = 'pending';
            }

            $targetPersen = match ($status) {
                'completed' => 100,
                'in_progress' => rand(10, 90),
                default => 0
            };

            $data[] = [
                'proyek_id'       => $proyekId,
                'nama_tahapan'    => $faker->randomElement($tahapanList),
                'target_persen'   => $targetPersen,
                'tanggal_mulai'   => $tanggalMulai->format('Y-m-d'),
                'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                'status'          => $status,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ];

            $counter++;
        }

        DB::table('tahapan_proyek')->insert($data);

        $this->command->info("✅ Seeder TahapanProyek berhasil ({$counter} data)");
    }
}
