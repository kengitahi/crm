<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_labels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('label_id');
            $table->unsignedInteger('task_id');
            $table->timestamps();

            $table->foreign('label_id', 'task_labels_label_id_foreign')->references('id')->on('task_label_list')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id', 'task_tags_task_id_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_labels');
    }
}
