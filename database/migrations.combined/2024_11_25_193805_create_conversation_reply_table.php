<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('conversation_id');
            $table->text('reply');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('company_id', 'conversation_reply_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('conversation_id', 'conversation_reply_conversation_id_foreign')->references('id')->on('conversation')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'conversation_reply_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversation_reply');
    }
}
