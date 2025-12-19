<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // PERBAIKAN: Gunakan Schema::table untuk menambah kolom
        Schema::table('proyeks', function (Blueprint $table) {
            if (!Schema::hasColumn('proyeks', 'dokumen')) {
                $table->string('dokumen')->nullable()->after('nama_proyek');
            }
        });
    }

    public function down(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->dropColumn('dokumen');
        });
    }
};
