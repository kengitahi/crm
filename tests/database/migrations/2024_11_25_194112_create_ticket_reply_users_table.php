<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReplyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reply_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ticket_reply_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('ticket_reply_id', 'ticket_reply_users_ticket_reply_id_foreign')->references('id')->on('ticket_replies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'ticket_reply_users_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_reply_users');
    }
}
