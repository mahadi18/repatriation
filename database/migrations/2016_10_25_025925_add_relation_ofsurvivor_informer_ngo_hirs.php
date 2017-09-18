<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationOfsurvivorInformerNgoHirs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ngohirs', function (Blueprint $table) {
            $table->string('survivor_informer_relation')->after('done_over_phone')->nullable();
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
            $table->dropColumn('survivor_informer_relation');
        });
    }
}
