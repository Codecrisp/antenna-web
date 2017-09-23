<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntennaRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antenna_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timestamp')->unsigned();
            $table->integer('timestamp_gps')->unsigned();
            $table->string('secret')->nullable();
			$table->integer('chipring_id')->unsigned();
			$table->integer('antenna_id')->unsigned();
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
        Schema::dropIfExists('antenna_records');
    }
}
