<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotalForCarePalnsLitigation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('care_plan_litigation', function (Blueprint $table) {
            $table->integer('litigation_id')->unsigned();
            $table->integer('care_plan_id')->unsigned();

            $table->foreign('litigation_id')->references('id')->on('litigations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('care_plan_id')->references('id')->on('care_plans')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['litigation_id', 'care_plan_id']);
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
        Schema::drop('care_plan_litigation');
    }

}
