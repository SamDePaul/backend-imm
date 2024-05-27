<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imm_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('profil_perusahaan');
            $table->string('email')->unique();
            $table->string('verification_code');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('no_hp');
            $table->integer('jml_karyawan');
            $table->string('tipe_perusahaan');
            $table->string('role')->default('users');
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
        Schema::dropIfExists('imm_profiles');
    }
}
