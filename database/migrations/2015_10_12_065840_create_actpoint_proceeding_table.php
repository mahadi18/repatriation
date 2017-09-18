<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActpointProceedingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actpoint_proceeding', function (Blueprint $table) {
            $table->integer('actpoint_id')->unsigned();
            $table->integer('proceeding_id')->unsigned();

            $table->foreign('actpoint_id')->references('id')->on('actpoints')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('proceeding_id')->references('id')->on('proceedings')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['actpoint_id', 'proceeding_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actpoint_proceeding');
    }
}
