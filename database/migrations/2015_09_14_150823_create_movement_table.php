<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('entry_date')->nullable();
            $table->integer('organization_id')->nullable();
            $table->integer('litigation_id')->nullable();
            $table->string('handed_to')->nullable();
            $table->string('destination_type')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone')->nullable();
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
        Schema::drop('movements');
    }
}
