<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgresProyekSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $this->command->info("🚀 Memulai ProgresProyekSeeder (TARGET 100 DATA)");

        // Ambil tahapan + proyek
        $tahapans = DB::table('tahapan_proyek')->get();

        if ($tahapans->isEmpty()) {
            $this->command->error('❌ Tahapan kosong! Jalankan TahapanProyekSeeder dulu.');
            return;
        }

        // Kosongkan progres (AMAN karena child)
        DB::table('progres_proyek')->delete();

        $catatanProgress = [
            'Progress berjalan sesuai rencana.',
            'Pekerjaan sesuai jadwal yang ditentukan.',
            'Tidak ada kendala berarti di lapangan.',
            'Material tersedia dan tenaga kerja mencukupi.',
            'Cuaca mendukung pelaksanaan pekerjaan.',
            'Ada sedikit hambatan namun masih terkendali.',
            'Pekerjaan mendekati target yang direncanakan.',
            'Koordinasi tim berjalan dengan baik.',
            'Kualitas pekerjaan sesuai standar.',
            'Finishing mulai dilakukan secara bertahap.',
        ];

        $data = [];
        $usedKeys = [];
        $MAX = 100;

        foreach ($tahapans as $tahapan) {
            if (count($data) >= $MAX) {
                break;
            }

            // Tentukan tanggal aman
            $mulai = Carbon::parse($tahapan->tanggal_mulai ?? now()->subMonth());
            $selesai = Carbon::parse($tahapan->tanggal_selesai ?? now());

            if ($mulai->greaterThan($selesai)) {
                [$mulai, $selesai] = [$selesai, $mulai];
            }

            $tanggal = $faker->dateTimeBetween($mulai, $selesai)->format('Y-m-d');

            // Hindari duplicate (tahap_id + tanggal)
            $key = $tahapan->id . '-' . $tanggal;
            if (isset($usedKeys[$key])) {
                continue;
            }
            $usedKeys[$key] = true;

            // Tentukan persen_real
            switch ($tahapan->status) {
                case 'pending':
                    $persen = $faker->numberBetween(0, 30);
                    break;
                case 'in_progress':
                    $target = $tahapan->target_persen ?? 50;
                    $persen = $faker->numberBetween(
                        max(10, $target - 15),
                        min(90, $target + 10)
                    );
                    break;
                case 'completed':
                    $persen = 100;
                    break;
                default:
                    $persen = $faker->numberBetween(0, 100);
            }

            $data[] = [
                'proyek_id'   => $tahapan->proyek_id,
                'tahap_id'    => $tahapan->id,
                'persen_real' => $persen,
                'tanggal'     => $tanggal,
                'catatan'     => $faker->randomElement($catatanProgress),
                'foto_progres'=> null,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ];
        }

        DB::table('progres_proyek')->insert($data);

        $this->command->info("✅ BERHASIL!");
        $this->command->info("📊 Total progres dibuat: " . count($data));
    }
}
