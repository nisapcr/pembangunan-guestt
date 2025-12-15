<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('lokasi_proyek')) {

            Schema::create('lokasi_proyek', function (Blueprint $table) {
                $table->id('lokasi_id');

                // Foreign Key
                $table->foreignId('proyek_id')
                      ->constrained('proyeks', 'proyek_id') // <-- diperbaiki
                      ->onDelete('cascade');

                $table->string('nama_lokasi');
                $table->text('alamat')->nullable();
                $table->decimal('lat', 10, 8)->nullable();
                $table->decimal('lng', 11, 8)->nullable();
                $table->json('geojson')->nullable();
                $table->string('denah_gambar')->nullable();
                $table->json('media_tambahan')->nullable();

                $table->timestamps();
                $table->softDeletes();

                // Index
                $table->index('proyek_id');
                $table->index(['lat', 'lng']);
            });

        }
    }

    public function down()
    {
        Schema::dropIfExists('lokasi_proyek');
    }
};
