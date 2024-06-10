<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMatricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_matrics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('matric_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('value');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('matric_id')->references('id')->on('metrics')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_matrics');
    }
}
