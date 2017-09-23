<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChipringPigeonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chipring_pigeon', function (Blueprint $table) {
			$table->integer('chipring_id')->unsigned();
			$table->integer('pigeon_id')->unsigned();

			$table->primary(['chipring_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chipring_pigeon');
    }
}
