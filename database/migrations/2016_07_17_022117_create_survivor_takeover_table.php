<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurvivorTakeoverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('takeovers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('doc_ids')->nullable();
            $table->boolean('complete')->default(0);
            $table->integer('litigation_id');
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
        Schema::drop('takeovers');
    }
}
