<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTemplateTaskUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_template_task_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_template_task_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('project_template_task_id', 'project_template_task_users_project_template_task_id_foreign')->references('id')->on('project_template_tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'project_template_task_users_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_template_task_users');
    }
}
