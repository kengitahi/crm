<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCommentEmojiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_comment_emoji', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('comment_id')->nullable();
            $table->string('emoji_name')->nullable();
            $table->timestamps();

            $table->foreign('comment_id', 'task_comment_emoji_comment_id_foreign')->references('id')->on('task_comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'task_comment_emoji_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_comment_emoji');
    }
}
