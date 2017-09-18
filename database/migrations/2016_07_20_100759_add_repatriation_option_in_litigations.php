<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepatriationOptionInLitigations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('litigations', function (Blueprint $table) {
            $table->integer('repatriation_option')->after('created_by_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('litigations', function (Blueprint $table) {
            $table->dropColumn(['repatriation_option']);
        });
    }
}
