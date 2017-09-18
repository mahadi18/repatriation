<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveLastViewedByFromMessageToMessageOrganization extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function($table)
        {
            $table->dropColumn('last_viewed_by');
            $table->dropTimestamps();

        });

        Schema::table('message_organization', function($table)
        {
            $table->integer('last_viewed_by')->default(0)->after('organization_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function($table)
        {
            $table->integer('last_viewed_by')->default(0)->after('sender');


        });

        Schema::table('message_organization', function($table)
        {
            $table->dropColumn('last_viewed_by');

        });
    }
}
