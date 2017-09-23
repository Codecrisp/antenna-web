<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 public function up()
     {
         Schema::table('clubs', function (Blueprint $table) {
 			$table->integer('section_id');
            $table->string('address')->nullable()->change();
            $table->string('zip_code')->nullable()->change();
            $table->string('city')->nullable()->change();
			$table->string('country')->nullable()->change();
            $table->integer('user_id')->nullable()->change();
            $table->dropColumn('afdeling');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('clubs', function (Blueprint $table) {
 			$table->dropColumn('section_id');
            $table->string('afdeling');
         });
     }
}
