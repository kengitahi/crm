<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionRepliesDiscussionRepliesDiscussionIdForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussion_replies', function (Blueprint $table) {
            $table->foreign('discussion_id', 'discussion_replies_discussion_id_foreign')->references('id')->on('discussions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discussion_replies', function (Blueprint $table) {
            $table->dropForeign('discussion_replies_discussion_id_foreign');
        });
    }
}
