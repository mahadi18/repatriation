<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCaseDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('litigation_task_task_status', function (Blueprint $table) {
            $table->integer('litigation_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->integer('task_status_id')->unsigned();
            $table->string('updated_by');
            $table->string('assigned_country');
            $table->string('message_id');
            $table->timestamps();

            $table->foreign('litigation_id')->references('id')->on('litigations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('task_status_id')->references('id')->on('task_statuses')
                ->onUpdate('cascade')->onDelete('cascade');


        });
        DB::statement('ALTER TABLE litigation_task_task_status ADD PRIMARY KEY ( litigation_id , task_id , assigned_country )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('litigation_task_task_status');
    }
}