<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('litigation_id');
            $table->integer('task_id');
            $table->string('title')->nullable();
            $table->string('care_of')->nullable();
            $table->string('relation_with_survivor')->nullable();
            $table->integer('country')->nullable();
            $table->integer('state')->nullable();
            $table->integer('district')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('contact_number')->nullable();
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
        Schema::drop('addresses');
    }
}
