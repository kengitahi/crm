<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTemplateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_template_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading');
            $table->mediumText('description')->nullable();
            $table->unsignedInteger('project_template_id');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->text('task_labels')->nullable();
            $table->unsignedInteger('project_template_task_category_id')->nullable();
            $table->timestamps();

            $table->foreign('project_template_id', 'project_template_tasks_project_template_id_foreign')->references('id')->on('project_templates')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_template_task_category_id', 'project_template_tasks_project_template_task_category_id_foreign')->references('id')->on('task_category')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_template_tasks');
    }
}
