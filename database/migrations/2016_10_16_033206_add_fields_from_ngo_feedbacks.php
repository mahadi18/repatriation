<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsFromNgoFeedbacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngohirs', function (Blueprint $table) {
            $table->string('eye_color')->after('birth_mark')->nullable();
            $table->string('hair_color')->after('birth_mark')->nullable();
            $table->string('identification_mark')->after('birth_mark')->nullable();
            $table->string('deformities')->after('birth_mark')->nullable();
            $table->string('guardian_occupation')->after('mother_name')->nullable();
            $table->string('guardian_monthly_income')->after('mother_name')->nullable();
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
            $table->dropColumn('eye_color');
            $table->dropColumn('hair_color');
            $table->dropColumn('identification_mark');
            $table->dropColumn('deformities');
            $table->dropColumn('guardian_occupation');
            $table->dropColumn('guardian_monthly_income');
        });
    }
}
