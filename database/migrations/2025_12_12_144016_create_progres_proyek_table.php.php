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
Schema::create('progres_proyek', function (Blueprint $table) {
    $table->bigIncrements('progres_id');

    // PROYEK
    $table->unsignedBigInteger('proyek_id');
    $table->foreign('proyek_id')
          ->references('proyek_id')
          ->on('proyeks')
          ->onDelete('cascade');

    // TAHAPAN (FIX)
    $table->unsignedBigInteger('tahap_id');
    $table->foreign('tahap_id')
          ->references('id') // ✅ BENAR
          ->on('tahapan_proyek')
          ->onDelete('cascade');

    $table->decimal('persen_real', 5, 2)->default(0);
    $table->date('tanggal')->nullable();
    $table->text('catatan')->nullable();
    $table->timestamps();

    $table->unique(['tahap_id', 'tanggal'], 'unique_tahap_tanggal');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_proyek');
    }
};
