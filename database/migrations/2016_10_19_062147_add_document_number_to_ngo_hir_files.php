<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentNumberToNgoHirFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngohirfiles', function (Blueprint $table) {
            $table->string('doc_no')->after('doc_type_id')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ngohirfiles', function (Blueprint $table) {
            $table->dropColumn('doc_no');
        });
    }
}
