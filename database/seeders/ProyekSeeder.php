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

        $jenisProyek = [
            'Pembangunan',
            'Renovasi',
            'Pemeliharaan'
        ];

        $objekProyek = [
            'Gedung',
            'Jalan',
            'Jembatan',
            'Sekolah',
            'Rumah Sakit',
            'Pasar'
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

        // Hapus data lama (aman untuk foreign key)
        DB::table('proyeks')->delete();

        $data = [];

        for ($i = 0; $i < 100; $i++) {

            $jenis  = $faker->randomElement($jenisProyek);
            $objek  = $faker->randomElement($objekProyek);
            $kota   = $faker->randomElement($lokasi);
            $tahun  = $faker->numberBetween(2020, 2025);
            $dana   = $faker->randomElement($sumberDana);

            $data[] = [
                'kode_proyek' => 'PRJ-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT) . '-' . rand(100, 999),
                'nama_proyek' => "$jenis $objek di $kota",
                'tahun'       => $tahun,
                'lokasi'      => $kota,
                'anggaran'    => $faker->randomFloat(2, 100000000, 50000000000),
                'sumber_dana' => $dana,
                'deskripsi'   => "Proyek $jenis $objek yang berlokasi di $kota ini dilaksanakan pada tahun $tahun dengan tujuan untuk meningkatkan kualitas infrastruktur serta mendukung pelayanan publik dan pertumbuhan ekonomi daerah. Proyek ini didanai melalui sumber dana $dana dan diharapkan dapat memberikan manfaat jangka panjang bagi masyarakat sekitar.",
                'dokumen'     => 'dokumen-proyek-' . ($i + 1) . '.pdf',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ];
        }

        DB::table('proyeks')->insert($data);

        $this->command->info('Seeder Proyek berhasil dijalankan! ' . count($data) . ' data ditambahkan.');
    }
}
