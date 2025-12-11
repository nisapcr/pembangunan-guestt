<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tahapan_proyek', function (Blueprint $table) {
            $table->bigIncrements('tahap_id');

            // Foreign Key ke proyek
            $table->unsignedBigInteger('proyek_id');
            $table->foreign('proyek_id')->references('proyek_id')->on('proyek')->onDelete('cascade');

            $table->string('nama_tahapan');
            $table->text('deskripsi')->nullable();
            $table->integer('target_persen')->default(0);

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahapan_proyek');
    }
};
