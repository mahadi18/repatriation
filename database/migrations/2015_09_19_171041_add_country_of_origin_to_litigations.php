<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryOfOriginToLitigations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('litigations', function($table)
        {
            $table->integer('country_of_origin')->default(1)->after('rescued_from_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('litigations', function($table)
        {
            $table->dropColumn('country_of_origin');
        });
    }
}
