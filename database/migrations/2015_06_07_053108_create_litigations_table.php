<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLitigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('litigations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('case_id')->nullable();
            $table->string('name_during_rescue')->nullable();
            $table->string('full_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->timestamp('rescued_at')->nullable();
            $table->string('rescued_from_address')->nullable();
            $table->integer('rescued_from_country')->nullable();
            $table->integer('rescued_from_state')->nullable();
            $table->integer('rescued_from_district')->nullable();
            $table->string('rescued_by')->nullable();
            $table->string('concerned_police_station_of_gd')->nullable();
            $table->string('concerned_police_station_of_fir')->nullable();
            $table->string('concerned_organization')->nullable();
            $table->string('nature_of_complaint')->nullable();
            $table->string('gd_number')->nullable();
            $table->date('gd_date')->nullable();
            $table->string('fir_number')->nullable();
            $table->date('fir_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('other_language')->nullable();
            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('sex', 1)->nullable();
            $table->string('marital_status', 1)->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('pregnancy')->nullable();
            $table->integer('created_by_id')->nullable();
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
		Schema::drop('litigations');
	}

}
