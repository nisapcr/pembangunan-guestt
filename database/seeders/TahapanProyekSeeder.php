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

        // Cari kolom ID yang benar di tabel proyek
        $proyekIdColumn = $this->findProyekIdColumn();

        if (!$proyekIdColumn) {
            $this->command->error('Tidak dapat menemukan kolom ID di tabel proyek!');
            return;
        }

        $proyekIds = DB::table('proyek')->pluck($proyekIdColumn);

        if ($proyekIds->isEmpty()) {
            $this->command->error('Tidak ada data proyek! Jalankan ProyekSeeder terlebih dahulu.');
            return;
        }

        $tahapanList = [
            'Perencanaan',
            'Persiapan',
            'Pengadaan',
            'Pelaksanaan',
            'Pengawasan',
            'Serah Terima',
            'Pemeliharaan'
        ];

        $statusList = ['pending', 'in_progress', 'completed'];

        DB::table('tahapan_proyek')->delete();

        $data = [];
        foreach ($proyekIds as $proyekId) {
            $jumlahTahapan = rand(3, 5);

            for ($i = 0; $i < $jumlahTahapan; $i++) {
                $tanggalMulai = $faker->dateTimeBetween('-1 year', '+6 months');
                $tanggalSelesai = $faker->dateTimeBetween($tanggalMulai, '+1 year');

                $data[] = [
                    'proyek_id' => $proyekId,
                    'nama_tahapan' => $tahapanList[$i] ?? $faker->word,
                    'deskripsi' => 'Deskripsi tahapan ' . ($tahapanList[$i] ?? $faker->word) . ' untuk proyek ini',
                    'target_persen' => $faker->numberBetween(0, 100),
                    'tanggal_mulai' => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                    'status' => $faker->randomElement($statusList),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        DB::table('tahapan_proyek')->insert($data);

        $this->command->info('Seeder Tahapan Proyek berhasil! ' . count($data) . ' data ditambahkan.');
    }

    private function findProyekIdColumn()
    {
        $columns = ['proxyek_id', 'id', 'proyek_id'];

        foreach ($columns as $column) {
            if (DB::getSchemaBuilder()->hasColumn('proyek', $column)) {
                $this->command->info("Menggunakan kolom: {$column}");
                return $column;
            }
        }

        return null;
    }
}
