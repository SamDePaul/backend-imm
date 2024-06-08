<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricIndicatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metric_indicator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('metric_id');
            $table->unsignedBigInteger('indicator_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('metric_id')->references('id')->on('metrics')->onDelete('cascade');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metric_indicator');
    }
}
