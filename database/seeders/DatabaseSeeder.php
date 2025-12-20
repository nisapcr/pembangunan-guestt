<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProyekSeeder::class,
            TahapanProyekSeeder::class,
            ProgresProyekSeeder::class,
            LokasiProyekSeeder::class,
            KontraktorSeeder::class,
        ]);
    }
}
