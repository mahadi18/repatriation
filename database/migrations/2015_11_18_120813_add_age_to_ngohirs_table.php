<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeToNgohirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngohirs', function (Blueprint $table) {
            $table->integer('age_year_part')->after('date_of_birth')->nullable();
            $table->integer('age_month_part')->after('age_year_part')->nullable();
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
            $table->dropColumn(['age_year_part', 'age_month_part']);
        });
    }
}
