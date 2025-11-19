<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProyekSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $sumberDana = [
            'APBN',
            'APBD Provinsi',
            'APBD Kabupaten/Kota',
            'Swasta',
            'Hibah',
            'Pinjaman Luar Negeri'
        ];

        $lokasi = [
            'Jakarta Pusat',
            'Surabaya',
            'Bandung',
            'Medan',
            'Semarang',
            'Makassar',
            'Palembang',
            'Balikpapan'
        ];

        // Hapus data existing tanpa truncate (karena ada foreign key)
        DB::table('proyek')->delete();

        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'kode_proyek' => 'PRJ-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT) . '-' . rand(100, 999),
                'nama_proyek' => $faker->randomElement(['Pembangunan', 'Renovasi', 'Pemeliharaan']) . ' ' .
                               $faker->randomElement(['Gedung', 'Jalan', 'Jembatan', 'Sekolah', 'Rumah Sakit', 'Pasar']) . ' ' .
                               $faker->city,
                'tahun' => $faker->numberBetween(2020, 2025),
                'lokasi' => $faker->randomElement($lokasi),
                'anggaran' => $faker->randomFloat(2, 100000000, 50000000000),
                'sumber_dana' => $faker->randomElement($sumberDana),
                'deskripsi' => $faker->text(200),
                'dokumen' => 'dokumen-proyek-' . ($i + 1) . '.pdf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('proyek')->insert($data);

        $this->command->info('Seeder Proyek berhasil dijalankan! ' . count($data) . ' data ditambahkan.');
    }
}
