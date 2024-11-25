<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mention_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('task_comment_id')->nullable();
            $table->unsignedInteger('task_note_id')->nullable();
            $table->unsignedInteger('task_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('project_note_id')->nullable();
            $table->unsignedInteger('discussion_id')->nullable();
            $table->unsignedInteger('ticket_id')->nullable();
            $table->unsignedInteger('event_id')->nullable();
            $table->unsignedInteger('user_chat_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('discussion_reply_id')->nullable();
            $table->timestamps();

            $table->foreign('discussion_id', 'mention_users_discussion_id_foreign')->references('id')->on('discussions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('discussion_reply_id', 'mention_users_discussion_reply_id_foreign')->references('id')->on('discussion_replies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_id', 'mention_users_event_id_foreign')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id', 'mention_users_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_note_id', 'mention_users_project_note_id_foreign')->references('id')->on('project_notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_comment_id', 'mention_users_task_comment_id_foreign')->references('id')->on('task_comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id', 'mention_users_task_id_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_note_id', 'mention_users_task_note_id_foreign')->references('id')->on('task_notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ticket_id', 'mention_users_ticket_id_foreign')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_chat_id', 'mention_users_user_chat_id_foreign')->references('id')->on('users_chat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'mention_users_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mention_users');
    }
}
