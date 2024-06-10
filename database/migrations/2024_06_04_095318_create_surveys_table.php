<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('business_name');
            $table->string('survey_title');
            $table->text('survey_description')->nullable();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_hp');
            $table->text('pertanyaan_1');
            $table->text('pertanyaan_2');
            $table->text('pertanyaan_3');
            $table->text('pertanyaan_4');
            $table->text('pertanyaan_5');
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
        Schema::dropIfExists('surveys');
    }
}
