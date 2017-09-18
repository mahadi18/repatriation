<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceedings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('date_of_order');
            $table->integer('litigation_id');
            $table->string('act');
            $table->string('document_type');
            $table->string('order_from');
            $table->string('notes');
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
        Schema::drop('proceedings');
    }
}
