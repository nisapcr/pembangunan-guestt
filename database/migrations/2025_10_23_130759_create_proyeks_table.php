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
        // PERBAIKAN: Menggunakan 'proyeks' (plural) agar konsisten dengan Eloquent Model default
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id('proyek_id'); // Primary Key
            $table->string('kode_proyek')->unique(); // Unique Key
            $table->string('nama_proyek');
            $table->string('tahun');
            $table->string('lokasi');
            // Menggunakan tipe data yang tepat untuk angka besar
            $table->decimal('anggaran', 15, 2); 
            $table->string('sumber_dana');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
