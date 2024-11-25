<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_chat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_one');
            $table->unsignedInteger('user_id');
            $table->mediumText('message')->nullable();
            $table->unsignedInteger('from')->nullable();
            $table->unsignedInteger('to')->nullable();
            $table->enum('message_seen', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->boolean('notification_sent')->default(1);

            $table->foreign('company_id', 'users_chat_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from', 'users_chat_from_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to', 'users_chat_to_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'users_chat_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_one', 'users_chat_user_one_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_chat');
    }
}
