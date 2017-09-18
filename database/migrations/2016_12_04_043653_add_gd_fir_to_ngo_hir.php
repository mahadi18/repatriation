<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGdFirToNgoHir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngohirs', function (Blueprint $table) {
            $table->string('case_filed_no')->after('case_filed_by_parents')->nullable();
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
            $table->dropColumn('case_filed_no');
        });
    }
}
