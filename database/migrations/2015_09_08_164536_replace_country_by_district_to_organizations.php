<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplaceCountryByDistrictToOrganizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->string('contact_person')->default('Not Added')->after('org_type');
            $table->string('contact_designation')->default('Not Added')->after('contact_person');
            $table->string('email')->default('Not Added')->after('contact_designation');
            $table->string('phone')->default('Not Added')->after('email');
            $table->integer('district_id')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function($table)
        {
            $table->dropColumn(['district_id', 'phone', 'email', 'contact_designation', 'contact_person']);
        });
    }
}
