<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lokasi_proyek', function (Blueprint $table) {
            $table->id('lokasi_id');

            // PERBAIKAN: Cek dulu apakah tabel proyeks ada
            if (Schema::hasTable('proyeks')) {
                // Gunakan foreignId hanya jika tabel proyeks ada
                $table->foreignId('proyek_id')
                      ->constrained('proyeks')
                      ->onDelete('cascade');
            } else {
                // Jika tabel proyeks tidak ada, buat kolom biasa dulu
                $table->unsignedBigInteger('proyek_id')->nullable();
            }

            $table->string('nama_lokasi');
            $table->text('alamat');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->json('geojson')->nullable();
            $table->string('denah_gambar')->nullable();
            $table->json('media_tambahan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index untuk pencarian
            $table->index('proyek_id');
            $table->index('nama_lokasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_proyek');
    }
};
