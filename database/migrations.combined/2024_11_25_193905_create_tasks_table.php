<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_short_code')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('heading');
            $table->longText('description')->nullable();
            $table->dateTime('due_date')->nullable()->index('tasks_due_date_index');
            $table->dateTime('start_date')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('task_category_id')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['incomplete', 'completed'])->default('incomplete');
            $table->unsignedInteger('board_column_id')->default(1);
            $table->integer('column_priority');
            $table->dateTime('completed_on')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('recurring_task_id')->nullable();
            $table->unsignedInteger('dependent_task_id')->nullable();
            $table->unsignedInteger('milestone_id')->nullable();
            $table->boolean('is_private')->default(0);
            $table->boolean('billable')->default(1);
            $table->integer('estimate_hours');
            $table->integer('estimate_minutes');
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->string('hash', 64)->nullable();
            $table->boolean('repeat')->default(0);
            $table->boolean('repeat_complete')->default(0);
            $table->integer('repeat_count')->nullable();
            $table->enum('repeat_type', ['day', 'week', 'month', 'year'])->default('day');
            $table->integer('repeat_cycles')->nullable();
            $table->text('event_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable()->index('tasks_deleted_at_index');
            $table->boolean('approval_send')->default(0);

            $table->foreign('added_by', 'tasks_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('board_column_id', 'tasks_board_column_id_foreign')->references('id')->on('taskboard_columns')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'tasks_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by', 'tasks_created_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('dependent_task_id', 'tasks_dependent_task_id_foreign')->references('id')->on('tasks')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'tasks_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('milestone_id', 'tasks_milestone_id_foreign')->references('id')->on('project_milestones')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'tasks_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recurring_task_id', 'tasks_recurring_task_id_foreign')->references('id')->on('tasks')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('task_category_id', 'tasks_task_category_id_foreign')->references('id')->on('task_category')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
