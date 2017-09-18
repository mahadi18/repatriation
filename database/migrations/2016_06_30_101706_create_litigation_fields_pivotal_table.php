<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLitigationFieldsPivotalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_litigation', function (Blueprint $table) {
            $table->integer('litigation_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->string('value');
            $table->foreign('litigation_id')->references('id')->on('litigations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('field_id')->references('id')->on('form_fields')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['litigation_id', 'field_id']);
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
        Schema::drop('field_litigation');
    }
}
