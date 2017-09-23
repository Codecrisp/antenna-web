<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigeonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigeons', function (Blueprint $table) {
            $table->increments('id');
			$table->string('number')->unique();
			$table->integer('birth_year')->nullable();
            $table->boolean('is_race_pigeon')->default(false);
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
			$table->integer('user_id')->nullable();
			$table->dateTime('pmv')->nullable();
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
        Schema::dropIfExists('pigeons');
    }
}
