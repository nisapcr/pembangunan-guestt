<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        DB::table('warga')->delete();

        $data = [];
        $usedKtp = [];

        $jenisKelamin = ['L', 'P'];
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaanList = [
            'PNS', 'Karyawan Swasta', 'Wiraswasta', 'Petani', 'Nelayan', 'Guru',
            'Dokter', 'Perawat', 'Pedagang', 'Buruh', 'Mahasiswa', 'Ibu Rumah Tangga',
            'Pensiunan', 'Tidak Bekerja'
        ];

        for ($i = 0; $i < 100; $i++) {
            $jenisKelaminValue = $faker->randomElement($jenisKelamin);
            $nama = $faker->name($jenisKelaminValue == 'L' ? 'male' : 'female');

            // Generate unique no_ktp
            do {
                $noKtp = $faker->unique()->numerify('32##############');
            } while (in_array($noKtp, $usedKtp));

            $usedKtp[] = $noKtp;

            $data[] = [
                'no_ktp' => $noKtp,
                'nama' => $nama,
                'jenis_kelamin' => $jenisKelaminValue,
                'agama' => $faker->randomElement($agamaList),
                'pekerjaan' => $faker->randomElement($pekerjaanList),
                'telp' => $faker->numerify('08##########'), // 12 digit
                'email' => $faker->unique()->safeEmail,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('warga')->insert($data);

        $this->command->info('Seeder Warga berhasil! 100 data ditambahkan.');
    }
}
