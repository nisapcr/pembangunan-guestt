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

            // Foreign Keys
            $table->unsignedBigInteger('proyek_id');
            $table->foreign('proyek_id')
                  ->references('proyek_id')
                  ->on('proyek')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('tahap_id');
            $table->foreign('tahap_id')
                  ->references('tahap_id')
                  ->on('tahapan_proyek')
                  ->onDelete('cascade');

            // Data Progress
            $table->decimal('persen_real', 5, 2)->default(0); // DECIMAL(5,2)
            $table->date('tanggal')->nullable();
            $table->text('catatan')->nullable();

            // Media/foto progres akan dihandle di tabel media (spatie-medialibrary)
            $table->timestamps();

            // Composite unique untuk mencegah duplikasi progres pada tanggal yang sama untuk tahap yang sama
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
