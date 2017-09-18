<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgohirfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngohirfiles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('litigation_id');
            $table->date('date_of_upload');
            $table->string('user_id');
            $table->string('doc_type_id');
            $table->string('comments')->nullable();
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
        Schema::drop('ngohirfiles');
    }
}
