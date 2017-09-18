<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgohirsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ngohirs', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('litigation_id')->nullable();
			$table->string('name_of_interviewer')->nullable();
			$table->string('place_of_interview')->nullable();
			$table->date('date_of_interview')->nullable();
			$table->string('name_of_informer')->nullable();
			$table->string('name_of_the_survivor_at_source')->nullable();
			$table->string('name_of_the_survivor_at_destination')->nullable();
			$table->string('father_name')->nullable();
			$table->string('mother_name')->nullable();
			$table->string('marital_status', 1)->nullable();
			$table->string('spouse_name')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('nationality', 1)->nullable();
			$table->string('religion')->nullable();
			$table->string('education')->nullable();
			$table->string('history_of_previous_stay')->nullable(); // textarea
			$table->integer('height_ft_part')->nullable();
			$table->integer('height_in_part')->nullable();
			$table->string('sex', 1)->nullable();
			$table->string('birth_mark')->nullable();
			$table->string('complexion')->nullable();
			$table->integer('pregnancy')->nullable();
			$table->integer('accompanying_with_survivor')->nullable();
			$table->integer('abuse')->nullable();
			$table->string('if_yes_type')->nullable();
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
		Schema::drop('ngohirs');
	}

}
