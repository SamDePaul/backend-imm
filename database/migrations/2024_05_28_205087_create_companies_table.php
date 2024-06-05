<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->text('profil_perusahaan')->nullable();
            $table->string('nama_pic');
            $table->string('posisi_pic');
            $table->string('nomor_telepon');
            $table->string('country');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->integer('jumlah_karyawan');
            $table->string('tipe_perusahaan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
