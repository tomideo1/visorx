<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataUsage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_usage', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('bytes_sent');
            $table->bigInteger('bytes_received');
            $table->string('computer_name');
            $table->string('logged_on_user');
            $table->timestamp('date_time_logged');
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
        Schema::dropIfExists('data_usage');
    }
}
