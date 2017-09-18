<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeToLitigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('litigations', function (Blueprint $table) {
            $table->dropColumn('rescued_at');
            $table->date('rescue_date')->after('nick_name')->nullable();
            $table->time('rescue_time')->after('rescue_date')->nullable();
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
        Schema::table('litigations', function (Blueprint $table) {
            $table->dropColumn(['age_year_part', 'age_month_part', 'rescue_date', 'rescue_time']);
            $table->timestamp('rescued_at')->after('nick_name')->nullable();
        });
    }
}
