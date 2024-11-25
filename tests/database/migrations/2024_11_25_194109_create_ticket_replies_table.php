<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id');
            $table->mediumText('message')->nullable();
            $table->enum('type', ['reply', 'note'])->default('reply');
            $table->timestamp('deleted_at')->nullable();
            $table->string('imap_message_id')->nullable();
            $table->string('imap_message_uid')->nullable();
            $table->string('imap_in_reply_to')->nullable();
            $table->timestamps();

            $table->foreign('ticket_id', 'ticket_replies_ticket_id_foreign')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'ticket_replies_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_replies');
    }
}
