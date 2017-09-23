<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_entries', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('pigeon_id');
			$table->integer('race_id');
			$table->integer('timestamp_dec')->nullable();
			$table->integer('secret');
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
        Schema::dropIfExists('race_entries');
    }
}
