<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KontraktorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check untuk memudahkan seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // GUNAKAN DB FACADE dengan nama tabel yang BENAR: 'kontraktor'
        DB::table('kontraktor')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil data proyek - GUNAKAN TABEL proyeks (plural)
        $proyekIds = [];

        try {
            // Coba ambil dari tabel proyeks
            if (DB::getSchemaBuilder()->hasTable('proyeks')) {
                // Periksa kolom primary key yang ada
                $columns = DB::getSchemaBuilder()->getColumnListing('proyeks');

                if (in_array('proyek_id', $columns)) {
                    $proyekIds = DB::table('proyeks')->pluck('proyek_id')->toArray();
                } elseif (in_array('id', $columns)) {
                    $proyekIds = DB::table('proyeks')->pluck('id')->toArray();
                } else {
                    // Ambil ID apapun yang ada
                    $proyekIds = DB::table('proyeks')->pluck(DB::raw('id'))->toArray();
                }

                $this->command->info('✅ Berhasil mengambil data dari tabel proyeks: ' . count($proyekIds) . ' data ditemukan');
            } else {
                $this->command->error('❌ Tabel proyeks tidak ditemukan di database!');
                $this->command->info('Jalankan migration terlebih dahulu: php artisan migrate');
            }
        } catch (\Exception $e) {
            $this->command->error('❌ Error mengambil data proyek: ' . $e->getMessage());
        }

        if (empty($proyekIds)) {
            $this->command->error('❌ ERROR: Tidak ada data proyek. Harus jalankan ProyekSeeder terlebih dahulu!');
            $this->command->info('Jalankan: php artisan db:seed --class=ProyekSeeder');

            // Buat dummy proyek ID untuk testing
            $proyekIds = range(1, 50);
            $this->command->warn('⚠️  Menggunakan dummy proyek ID untuk testing: ' . implode(', ', $proyekIds));
        }

        $daftarNamaPerusahaan = [
            'PT. Bangun Jaya Abadi', 'CV. Teguh Konstruksi', 'PT. Mega Konstruksi', 'UD. Jaya Bangun',
            'PT. Adhi Karya', 'CV. Berkat Jaya', 'PT. Wijaya Karya', 'UD. Sentosa Abadi',
            'PT. Cipta Bangun', 'CV. Mitra Sejahtera', 'PT. Graha Indah', 'UD. Makmur Jaya',
            'PT. Bangun Persada', 'CV. Sumber Rejeki', 'PT. Anugerah Konstruksi', 'UD. Lancar Jaya',
            'PT. Bina Utama', 'CV. Prima Bangun', 'PT. Tunas Jaya', 'UD. Cahaya Abadi',
            'PT. Sinar Konstruksi', 'CV. Mandiri Bangun', 'PT. Karya Bersama', 'UD. Sejahtera Sentosa',
            'PT. Nusantara Bangun', 'CV. Andalan Konstruksi', 'PT. Gemilang Karya', 'UD. Maju Terus',
            'PT. Bumi Indah', 'CV. Cemerlang Bangun', 'PT. Dharma Karya', 'UD. Sukses Makmur',
            'PT. Alam Indah', 'CV. Berkah Abadi', 'PT. Harmoni Bangun', 'UD. Pancaran Karya',
            'PT. Sakti Konstruksi', 'CV. Pelopor Bangun', 'PT. Mulia Karya', 'UD. Jaya Sentosa',
            'PT. Bintang Konstruksi', 'CV. Semesta Bangun', 'PT. Utama Karya', 'UD. Bahagia Jaya',
            'PT. Lestari Bangun', 'CV. Mapan Konstruksi', 'PT. Sentosa Karya', 'UD. Makmur Sentosa',
            'PT. Indah Karya', 'CV. Jaya Makmur'
        ];

        $daftarNamaPenanggungJawab = [
            'Budi Santoso', 'Ahmad Hidayat', 'Siti Rahmawati', 'Joko Widodo', 'Rina Marlina',
            'Dedi Supriyadi', 'Linda Sari', 'Agus Salim', 'Wawan Setiawan', 'Dewi Anggraini',
            'Hendra Gunawan', 'Maya Sari', 'Fajar Nugroho', 'Sari Dewi', 'Irwan Saputra',
            'Yuni Astuti', 'Rudi Hartono', 'Nina Fitriani', 'Bambang Prasetyo', 'Desi Ratnasari',
            'Eko Susanto', 'Lina Wati', 'Ferry Irawan', 'Mira Susanti', 'Hari Purnomo',
            'Tuti Alawiyah', 'Rizki Ramadhan', 'Ani Sulistyo', 'Doni Permana', 'Eva Rosdiana',
            'Firman Syah', 'Gita Maharani', 'Hadi Pranoto', 'Intan Permata', 'Jefri Haryanto',
            'Kartika Sari', 'Lukman Hakim', 'Meta Indriani', 'Nando Pratama', 'Oki Setiawan',
            'Putri Ayu', 'Rahmat Hidayat', 'Siska Melati', 'Teguh Wijaya', 'Umi Kulsum',
            'Vino Maulana', 'Widiastuti', 'Yoga Pratama', 'Zahra Fitri', 'Ade Kurniawan'
        ];

        $daftarKota = [
            'Jakarta', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Medan',
            'Makassar', 'Balikpapan', 'Palembang', 'Malang', 'Bogor', 'Depok',
            'Tangerang', 'Bekasi', 'Solo', 'Manado', 'Denpasar', 'Batam', 'Pekanbaru', 'Pontianak'
        ];

        $kontraktors = [];

        // Data untuk statistik
        $stats = [
            'total' => 0,
            'kontak_valid' => 0,
            'berbadan_hukum' => 0,
            'proyek_terhubung' => [],
        ];

        // Buat 100 kontraktor SEMUA terhubung ke proyek
        for ($i = 1; $i <= 100; $i++) {
            $namaPerusahaan = $daftarNamaPerusahaan[array_rand($daftarNamaPerusahaan)];
            $penanggungJawab = $daftarNamaPenanggungJawab[array_rand($daftarNamaPenanggungJawab)];

            // Pilih proyek ID secara acak dari yang tersedia
            $proyek_id = $proyekIds[array_rand($proyekIds)];

            // Format nomor telepon yang valid
            $kodeArea = ['21', '22', '24', '31', '32', '33', '34', '35', '36', '61'];
            $selectedKodeArea = $kodeArea[array_rand($kodeArea)];
            $nomorTelepon = rand(80000000, 89999999);

            // Format kontak yang berbeda-beda
            $formatKontak = rand(1, 4);
            switch ($formatKontak) {
                case 1:
                    $kontak = "+62 {$selectedKodeArea} {$nomorTelepon}";
                    break;
                case 2:
                    $kontak = "+62 {$selectedKodeArea}-" . substr($nomorTelepon, 0, 4) . "-" . substr($nomorTelepon, 4, 4);
                    break;
                case 3:
                    $kontak = "0{$selectedKodeArea}" . substr($nomorTelepon, 0, 4) . substr($nomorTelepon, 4, 4);
                    break;
                default:
                    $kontak = "+62{$selectedKodeArea}{$nomorTelepon}";
            }

            // Alamat acak dengan variasi
            $kota = $daftarKota[array_rand($daftarKota)];
            $jalan = ['Jl. Merdeka', 'Jl. Sudirman', 'Jl. Gatot Subroto', 'Jl. Thamrin',
                     'Jl. Pahlawan', 'Jl. Ahmad Yani', 'Jl. Diponegoro', 'Jl. Asia Afrika',
                     'Jl. Majapahit', 'Jl. Hayam Wuruk', 'Jl. Gajah Mada', 'Jl. Imam Bonjol',
                     'Jl. Sisingamangaraja', 'Jl. Suryo Pranoto', 'Jl. Juanda', 'Jl. Kertajaya',
                     'Jl. Darmo', 'Jl. Raya', 'Jl. Kebon Sirih', 'Jl. Cikini'];
            $selectedJalan = $jalan[array_rand($jalan)];
            $nomor = rand(1, 200);

            // Tambahkan variasi alamat
            $tipeAlamat = ['No.', 'Blok', 'Komplek', 'Kav.', 'RT', 'RW', 'Gang'];
            $selectedTipe = $tipeAlamat[array_rand($tipeAlamat)];

            // Format alamat yang berbeda-beda
            switch ($selectedTipe) {
                case 'Komplek':
                    $alamat = "{$selectedJalan} Komplek {$this->generateKomplekName()} No. {$nomor}, {$kota}";
                    break;
                case 'Blok':
                    $blok = chr(65 + rand(0, 5)); // A-F
                    $alamat = "{$selectedJalan} Blok {$blok} No. {$nomor}, {$kota}";
                    break;
                case 'RT':
                case 'RW':
                    $rt = rand(1, 10);
                    $rw = rand(1, 5);
                    $alamat = "{$selectedJalan} RT {$rt}/RW {$rw} No. {$nomor}, {$kota}";
                    break;
                default:
                    $alamat = "{$selectedJalan} {$selectedTipe} {$nomor}, {$kota}";
            }

            // Cek apakah kontak valid
            if (preg_match('/^[0-9+\-\s()]+$/', $kontak)) {
                $stats['kontak_valid']++;
            }

            // Cek apakah berbadan hukum (PT/Tbk)
            $namaDenganTbk = $namaPerusahaan . (rand(1, 3) == 1 ? ' Tbk.' : '');
            if (str_contains($namaDenganTbk, 'PT.') || str_contains($namaDenganTbk, 'Tbk')) {
                $stats['berbadan_hukum']++;
            }

            // Track proyek terhubung
            if (!isset($stats['proyek_terhubung'][$proyek_id])) {
                $stats['proyek_terhubung'][$proyek_id] = 0;
            }
            $stats['proyek_terhubung'][$proyek_id]++;

            // JANGAN TAMBAHKAN kontraktor_id secara manual (auto-increment)
            $kontraktors[] = [
                'proyek_id' => $proyek_id, // SEMUA terhubung ke proyek
                'nama' => $namaDenganTbk,
                'penanggung_jawab' => $penanggungJawab,
                'kontak' => $kontak,
                'alamat' => $alamat,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now(),
            ];

            $stats['total']++;
        }

        // Insert data ke database - GUNAKAN DB FACADE dengan nama tabel 'kontraktor'
        try {
            DB::table('kontraktor')->insert($kontraktors);
            $this->command->info('✅ Seeder Kontraktor berhasil dijalankan! ' . $stats['total'] . ' data kontraktor telah dibuat.');
        } catch (\Exception $e) {
            $this->command->error('❌ Error insert data: ' . $e->getMessage());
            return;
        }

        // Tampilkan statistik
        $this->command->info("\n📊 Statistik Kontraktor:");
        $this->command->info('   • Total kontraktor: ' . $stats['total']);
        $this->command->info('   • Kontak valid: ' . $stats['kontak_valid'] . ' (' . round(($stats['kontak_valid'] / $stats['total']) * 100) . '%)');
        $this->command->info('   • Berbadan hukum (PT/Tbk): ' . $stats['berbadan_hukum'] . ' (' . round(($stats['berbadan_hukum'] / $stats['total']) * 100) . '%)');
        $this->command->info('   • Semua kontraktor TERHUBUNG ke proyek: ✓ 100%');

        // Tampilkan distribusi per proyek
        $this->command->info("\n📋 Distribusi Kontraktor per Proyek:");
        $this->command->info("=====================================");

        arsort($stats['proyek_terhubung']);
        $counter = 0;

        foreach ($stats['proyek_terhubung'] as $proyekId => $jumlah) {
            $counter++;
            $this->command->info($counter . ". Proyek ID: {$proyekId} - Jumlah kontraktor: {$jumlah}");

            if ($counter >= 10) {
                $this->command->info('   ... dan ' . (count($stats['proyek_terhubung']) - 10) . ' proyek lainnya');
                break;
            }
        }

        // Tampilkan contoh data
        $this->command->info("\n📋 Contoh Data Kontraktor (3 pertama):");
        $this->command->info("=====================================");

        for ($i = 0; $i < min(3, count($kontraktors)); $i++) {
            $kontraktor = $kontraktors[$i];

            $this->command->info(($i + 1) . ". " . $kontraktor['nama']);
            $this->command->info("   Penanggung Jawab: " . $kontraktor['penanggung_jawab']);
            $this->command->info("   ID Proyek: " . $kontraktor['proyek_id']);
            $this->command->info("   Kontak: " . $kontraktor['kontak']);
            $this->command->info("   Kontak Valid: " . (preg_match('/^[0-9+\-\s()]+$/', $kontraktor['kontak']) ? '✓' : '✗'));
            $this->command->info("   Alamat: " . substr($kontraktor['alamat'], 0, 40) . "...");
            $this->command->info("   Ditambahkan: " . Carbon::parse($kontraktor['created_at'])->format('d M Y'));
            $this->command->info("   ---");
        }
    }

    private function generateKomplekName()
    {
        $names = ['Permata', 'Indah', 'Asri', 'Sejahtera', 'Bunga', 'Mekar', 'Harapan', 'Mulia'];
        return $names[array_rand($names)] . ' ' . rand(1, 10);
    }
}
