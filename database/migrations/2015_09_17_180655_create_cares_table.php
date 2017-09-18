<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cares', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->integer('litigation_id')->nullable();
            $table->integer('treatment_type')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('attachment')->nullable();
            $table->string('action_summary')->nullable();
            $table->string('notes')->nullable();
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
        Schema::drop('cares');
    }
}
