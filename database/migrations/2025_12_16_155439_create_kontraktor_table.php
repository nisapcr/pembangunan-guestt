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
        Schema::create('kontraktor', function (Blueprint $table) {
            $table->bigIncrements('kontraktor_id');

            // Foreign Key
            $table->unsignedBigInteger('proyek_id');
            $table->foreign('proyek_id')
                  ->references('proyek_id')
                  ->on('proyek')
                  ->onDelete('cascade');

            // Data Kontraktor
            $table->string('nama', 100);
            $table->string('penanggung_jawab', 100);
            $table->string('kontak', 20);
            $table->text('alamat');

            $table->timestamps();

            // Index untuk pencarian
            $table->index('nama');
            $table->index('penanggung_jawab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontraktor');
    }
};
