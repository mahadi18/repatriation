<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInProgressFeildsInNgohir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngohirs', function (Blueprint $table) {
            $table->boolean('interview_info')->after('if_yes_type')->default(false);
            $table->boolean('basic_info')->after('interview_info')->default(false);
            $table->boolean('address_at_source')->after('basic_info')->default(false);
            $table->boolean('physical_desc')->after('address_at_source')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ngohirs', function (Blueprint $table) {
            $table->dropColumn(['interview_info', 'basic_info','address_at_source', 'physical_desc']);
        });
    }
}
