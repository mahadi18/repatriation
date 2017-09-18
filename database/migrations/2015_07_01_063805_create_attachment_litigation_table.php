<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentLitigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_litigation', function (Blueprint $table) {
            $table->integer('attachment_id')->unsigned();
            $table->integer('litigation_id')->unsigned();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('litigation_id')->references('id')->on('litigations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('attachment_id')->references('id')->on('attachments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['litigation_id', 'attachment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachment_litigation');
    }
}
