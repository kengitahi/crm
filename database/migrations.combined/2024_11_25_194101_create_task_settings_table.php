<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->enum('task_category', ['yes', 'no'])->default('yes');
            $table->enum('project', ['yes', 'no'])->default('yes');
            $table->enum('start_date', ['yes', 'no'])->default('yes');
            $table->enum('due_date', ['yes', 'no'])->default('yes');
            $table->enum('assigned_to', ['yes', 'no'])->default('yes');
            $table->enum('assigned_by', ['yes', 'no'])->default('yes');
            $table->enum('description', ['yes', 'no'])->default('yes');
            $table->enum('label', ['yes', 'no'])->default('yes');
            $table->enum('status', ['yes', 'no'])->default('yes');
            $table->enum('priority', ['yes', 'no'])->default('yes');
            $table->enum('make_private', ['yes', 'no'])->default('yes');
            $table->enum('time_estimate', ['yes', 'no'])->default('yes');
            $table->enum('hours_logged', ['yes', 'no'])->default('yes');
            $table->enum('custom_fields', ['yes', 'no'])->default('yes');
            $table->enum('copy_task_link', ['yes', 'no'])->default('yes');
            $table->enum('files', ['yes', 'no'])->default('yes');
            $table->enum('sub_task', ['yes', 'no'])->default('yes');
            $table->enum('comments', ['yes', 'no'])->default('yes');
            $table->enum('time_logs', ['yes', 'no'])->default('yes');
            $table->enum('notes', ['yes', 'no'])->default('yes');
            $table->enum('history', ['yes', 'no'])->default('yes');
            $table->timestamps();

            $table->foreign('company_id', 'task_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_settings');
    }
}
