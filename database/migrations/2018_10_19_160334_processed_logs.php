<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcessedLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processed_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source_ip')->default('NULL');
            $table->string('source_mac')->default('NULL');
            $table->string('destination_ip')->default('NULL');
            $table->string('url')->default('NULL');
            $table->integer('packet_size')->nullable();
            $table->string('destination_mac')->default('NULL');
            $table->string('computer_name')->default('NULL');
            $table->string('logged_on_user')->default('NULL');
            $table->timestamp('date_time_logged')->nullable();
            $table->timestamp('date_time_processed')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processed_logs');
    }
}
