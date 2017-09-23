<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntennasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antennas', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
			$table->string('last_action')->default('Pigeon has arrived');
            $table->string('firmware')->default('January 22, 2016');
            $table->string('status')->default('Idle');
            $table->string('status_color')->default('warning');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('type')->default(0);
            $table->string('serial')->nullable();
            $table->string('decryption_key', 64)->default('87d5662fcb9fb841df135a0871e2e118632aca007b1706e30257e91df2e032dd');
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
        Schema::dropIfExists('antennas');
    }
}
