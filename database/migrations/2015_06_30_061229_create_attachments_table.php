<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('content_type')->nullable();
            $table->string('file_path')->nullable();
            $table->string('comment')->nullable();
            $table->string('uploaded_by')->nullable();
            $table->string('doc_type_id')->nullable();
            $table->string('user_defined_doc_type_id')->nullable();
            $table->string('task_id')->nullable();
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
		Schema::drop('attachments');
	}

}
