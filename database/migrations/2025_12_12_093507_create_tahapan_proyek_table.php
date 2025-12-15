    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up()
{
    Schema::create('tahapan_proyek', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('proyek_id')->index();
        $table->string('nama_tahapan');
        $table->integer('target_persen')->default(0);
        $table->date('tanggal_mulai')->nullable();
        $table->date('tanggal_selesai')->nullable();
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('tahapan_proyek');
}

    };
