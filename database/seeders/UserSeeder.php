<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $data = [];

        $domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'student.pcr.ac.id'];

        // USER 1: ADMIN (email khusus untuk admin)
        $data[] = [
            'name' => 'Administrator',
            'email' => 'admin@proyek.com',  
            'email_verified_at' => now(),
            'password' => Hash::make('Admin123'), // Password mudah diingat
            'role' => 'admin', // TAMBAHKAN INI
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // USER 2: PETUGAS
        $data[] = [
            'name' => 'Petugas Proyek',
            'email' => 'petugas@proyek.com',
            'email_verified_at' => now(),
            'password' => Hash::make('petugas123'),
            'role' => 'petugas', // TAMBAHKAN INI
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // USER 3-102: USER BIASA
        for ($i = 3; $i <= 102; $i++) { // Mulai dari 3 karena sudah ada 2 user di atas
            $name = $faker->name;
            $domain = $faker->randomElement($domains);

            // Generate email unik berdasarkan nama
            $emailUsername = strtolower(preg_replace('/[^a-z0-9]/', '.', $name));
            $email = $emailUsername . $i . '@' . $domain;

            // Password yang berbeda-beda
            $passwords = ['password123', 'secret123', 'user12345', 'testpassword', 'indonesia123'];
            $password = Hash::make($faker->randomElement($passwords));

            $data[] = [
                'name' => $name,
                'email' => $email,
                'email_verified_at' => $faker->optional(0.8)->dateTimeBetween('-1 year', 'now'), // 80% verified
                'password' => $password,
                'role' => 'user', // TAMBAHKAN INI (default user)
                'remember_token' => $faker->optional(0.4)->sha1, // 40% punya remember token
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('users')->insert($data);

        $this->command->info('Seeder User berhasil! ' . count($data) . ' data user ditambahkan.');
        $this->command->info('Admin: admin@proyek.com / admin123');
        $this->command->info('Petugas: petugas@proyek.com / petugas123');
    }
}
