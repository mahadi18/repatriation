<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('litigation_id');
            $table->string('full_name')->nullable();
            $table->string('sex', 1)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('child_image_attachment')->nullable();
            $table->string('accompanying_with_survivor')->nullable();
            $table->string('child_litigation_id')->nullable();
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
        Schema::drop('children');
    }
}
