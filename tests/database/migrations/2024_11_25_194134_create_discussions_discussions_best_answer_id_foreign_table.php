<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsDiscussionsBestAnswerIdForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->foreign('best_answer_id', 'discussions_best_answer_id_foreign')->references('id')->on('discussion_replies')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->dropForeign('discussions_best_answer_id_foreign');
        });
    }
}
