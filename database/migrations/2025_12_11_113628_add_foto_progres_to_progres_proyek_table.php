<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('progres_proyek', function (Blueprint $table) {
            $table->string('foto_progres')->nullable()->after('catatan');
        });
    }

    public function down()
    {
        Schema::table('progres_proyek', function (Blueprint $table) {
            $table->dropColumn('foto_progres');
        });
    }
};
