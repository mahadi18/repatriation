<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditBodyColumnToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('messages', function (Blueprint $table) {
            $table->text('body')->nullable()->change();
            $table->integer('last_viewed_by')->nullable()->change();
            $table->integer('parent_message')->nullable()->change();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*DB::statement('ALTER TABLE `messages`
                          MODIFY `body` TEXT NOT NULL,
                          MODIFY `last_viewed_by` INTEGER(11) NOT NULL,
                          MODIFY `parent_message` INTEGER(11) NOT NULL;');*/
    }
}
