<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTemplateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_template_sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_template_task_id');
            $table->text('title');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->enum('status', ['incomplete', 'complete'])->default('incomplete');
            $table->timestamps();

            $table->foreign('project_template_task_id', 'project_template_sub_tasks_project_template_task_id_foreign')->references('id')->on('project_template_tasks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_template_sub_tasks');
    }
}
