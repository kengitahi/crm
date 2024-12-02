<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('project_name');
            $table->string('project_short_code')->nullable();
            $table->longText('project_summary')->nullable();
            $table->unsignedInteger('project_admin')->nullable();
            $table->date('start_date');
            $table->date('deadline')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('team_id')->nullable();
            $table->mediumText('feedback')->nullable();
            $table->enum('manual_timelog', ['enable', 'disable'])->default('disable');
            $table->enum('client_view_task', ['enable', 'disable'])->default('disable');
            $table->enum('allow_client_notification', ['enable', 'disable'])->default('disable');
            $table->tinyInteger('completion_percent');
            $table->enum('calculate_task_progress', ['true', 'false'])->default('true');
            $table->double('project_budget', 20, 2)->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->double('hours_allocated', 30, 2)->nullable();
            $table->string('status')->default('in progress');
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('hash')->nullable();
            $table->tinyInteger('public');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable()->index('projects_deleted_at_index');
            $table->boolean('enable_miroboard')->default(0);
            $table->string('miro_board_id')->nullable();
            $table->boolean('client_access')->default(0);
            $table->enum('public_taskboard', ['enable', 'disable'])->default('enable');
            $table->enum('public_gantt_chart', ['enable', 'disable'])->default('enable');
            $table->enum('need_approval_by_admin', ['0', '1'])->default('0');

            $table->foreign('added_by', 'projects_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('category_id', 'projects_category_id_foreign')->references('id')->on('project_category')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'projects_client_id_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'projects_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'projects_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'projects_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_admin', 'projects_project_admin_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('team_id', 'projects_team_id_foreign')->references('id')->on('teams')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
