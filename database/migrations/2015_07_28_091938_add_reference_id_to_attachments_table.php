<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenceIdToAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('official_reference_id')->nullable()->after('file_name');
            $table->string('organizational_reference_id')->nullable()->after('official_reference_id');
            $table->date('attachment_issue_date')->nullable()->after('organizational_reference_id');

            $table->dropColumn('task_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('task_id')->nullable()->after('user_defined_doc_type_id');

            $table->dropColumn(['official_reference_id', 'organizational_reference_id', 'attachment_issue_date']);
        });
    }
}
