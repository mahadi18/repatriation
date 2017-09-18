<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CaseProfile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('case_profiles', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('litigation_id');
            $table->integer('activity_id');
            $table->integer('task_id');
            $table->integer('status_id');
            $table->string('comments');
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
        Schema::drop('case_profiles');
	}

}
