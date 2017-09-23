<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packets', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('type')->unsigned()->nullable();
			$table->integer('msg_nr')->unsigned()->nullable();
			$table->integer('msg_timestamp')->unsigned()->nullable();
			$table->string('message')->nullable();
			$table->integer('connection_id')->nullable();
            $table->boolean('outgoing');
			$table->boolean('processed')->default(false);
			$table->text('raw')->nullable(); //Use only if packet can't be decrypted / decoded
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
        Schema::dropIfExists('packets');
    }
}
