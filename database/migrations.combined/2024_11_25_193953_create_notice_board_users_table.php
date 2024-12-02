<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeBoardUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_board_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('notice_id');
            $table->enum('type', ['employee', 'client'])->default('employee');
            $table->unsignedInteger('user_id');

            $table->foreign('notice_id', 'notice_board_users_notice_id_foreign')->references('id')->on('notices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'notice_board_users_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_board_users');
    }
}
