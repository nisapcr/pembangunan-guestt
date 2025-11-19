<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ProyekSeeder::class,      // Harus dijalankan dulu
            TahapanProyekSeeder::class, // Baru kemudian tahapan
        ]);
    }
}
