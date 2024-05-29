<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metric_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('metric_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('metric_id')->references('id')->on('metrics')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metric_tags');
    }
}
