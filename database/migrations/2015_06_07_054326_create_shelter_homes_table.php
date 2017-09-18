<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelterHomesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shelter_homes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('location');
            $table->string('country');
            $table->integer('capacity');
            $table->string('services')->nullable();
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
		Schema::drop('shelter_homes');
	}

}
