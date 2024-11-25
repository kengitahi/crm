<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('task_id', 'task_users_task_id_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'task_users_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_users');
    }
}
