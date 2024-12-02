<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('sub_task_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->text('details');
            $table->unsignedInteger('board_column_id')->nullable();
            $table->timestamps();

            $table->foreign('board_column_id', 'task_history_board_column_id_foreign')->references('id')->on('taskboard_columns')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('sub_task_id', 'task_history_sub_task_id_foreign')->references('id')->on('sub_tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id', 'task_history_task_id_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'task_history_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_history');
    }
}
