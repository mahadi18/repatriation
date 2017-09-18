<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotalTableForShelterHomeAndCarePlan extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('care_plan_shelter_home', function (Blueprint $table) {
            $table->integer('shelter_home_id')->unsigned();
            $table->integer('care_plan_id')->unsigned();

            $table->foreign('shelter_home_id')->references('id')->on('shelter_homes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('care_plan_id')->references('id')->on('care_plans')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['shelter_home_id', 'care_plan_id']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('care_plan_shelter_home');
	}

}
