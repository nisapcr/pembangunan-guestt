<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('tahapan_proyek')) {
            Schema::table('tahapan_proyek', function (Blueprint $table) {
                if (Schema::hasColumn('tahapan_proyek', 'tanggal_mulai')) {
                    $table->date('tanggal_mulai')->nullable()->change();
                }
                if (Schema::hasColumn('tahapan_proyek', 'tanggal_selesai')) {
                    $table->date('tanggal_selesai')->nullable()->change();
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('tahapan_proyek')) {
            Schema::table('tahapan_proyek', function (Blueprint $table) {
                if (Schema::hasColumn('tahapan_proyek', 'tanggal_mulai')) {
                    $table->date('tanggal_mulai')->nullable(false)->change();
                }
                if (Schema::hasColumn('tahapan_proyek', 'tanggal_selesai')) {
                    $table->date('tanggal_selesai')->nullable(false)->change();
                }
            });
        }
    }
};
