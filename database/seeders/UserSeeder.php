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

        for ($i = 1; $i <= 100; $i++) {
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
                'remember_token' => $faker->optional(0.4)->sha1, // 40% punya remember token
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('users')->insert($data);

        $this->command->info('Seeder User berhasil! ' . count($data) . ' data user baru ditambahkan.');
    }
}
