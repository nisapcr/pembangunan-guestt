<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('multipleuploads', function (Blueprint $table) {
            $table->id();
            $table->string('ref_table', 100); // Tambahkan ini
            $table->unsignedBigInteger('ref_id'); // Tambahkan ini
            $table->string('filename');
            $table->string('original_name')->nullable();
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index untuk performa
            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('multipleuploads');
    }
};
