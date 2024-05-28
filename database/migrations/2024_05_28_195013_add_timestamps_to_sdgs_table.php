<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToSdgsTable extends Migration
{
    public function up()
    {
        Schema::table('sdgs', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('sdgs', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
