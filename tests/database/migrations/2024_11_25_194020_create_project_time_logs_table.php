<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTimeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_time_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('task_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->dateTime('start_time')->index('project_time_logs_start_time_index');
            $table->dateTime('end_time')->nullable()->index('project_time_logs_end_time_index');
            $table->text('memo')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('total_minutes')->nullable();
            $table->unsignedInteger('edited_by_user')->nullable();
            $table->integer('hourly_rate');
            $table->double('earnings');
            $table->boolean('approved')->default(1);
            $table->unsignedInteger('approved_by')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->string('total_break_minutes')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'project_time_logs_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('approved_by', 'project_time_logs_approved_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'project_time_logs_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('edited_by_user', 'project_time_logs_edited_by_user_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('invoice_id', 'project_time_logs_invoice_id_foreign')->references('id')->on('invoices')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'project_time_logs_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'project_time_logs_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id', 'project_time_logs_task_id_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'project_time_logs_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_time_logs');
    }
}
