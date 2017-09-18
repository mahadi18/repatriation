<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLitigationFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

    public function up()
    {
        Schema::create('litigation_form', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('litigation_id')->nullable();
            $table->date('date_of_action')->nullable();
            $table->date('date_of_acknowledgement')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('form_id')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::drop('litigation_form');
    }


}
