<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->text('definition');
            $table->text('calculation')->nullable();
            $table->text('usage_guidance');
            $table->boolean('social');
            $table->boolean('environmental');
            $table->string('section');
            $table->string('subsection')->nullable();
            $table->integer('level_type')->default(1);
            $table->string('related_metrics_code')->nullable();
            $table->string('metric_level');
            $table->string('quantity_type');
            $table->string('reporting_format');
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
        Schema::dropIfExists('metrics');
    }
}
