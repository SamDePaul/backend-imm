<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('tujuan');
            $table->string('targetPelanggan');
            $table->datetime('tanggalMulai');
            $table->datetime('tanggalSelesai');
            $table->foreignId('negara_id');
            $table->foreignId('provinsi_id');
            $table->foreignId('kota_id');
            $table->string('data_path');
            $table->string('kategori');
            $table->decimal('dana', 15, 2);
            $table->string('jenis_dana');
            $table->decimal('dana_lain', 15, 2);
            $table->foreignId('sdg_id');
            $table->foreignId('indikator_id');
            $table->foreignId('matrik_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
