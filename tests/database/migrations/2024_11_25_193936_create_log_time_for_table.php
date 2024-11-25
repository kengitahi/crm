<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTimeForTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_time_for', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->enum('log_time_for', ['project', 'task'])->default('project');
            $table->enum('auto_timer_stop', ['yes', 'no'])->default('no');
            $table->tinyInteger('approval_required');
            $table->tinyInteger('tracker_reminder');
            $table->tinyInteger('timelog_report');
            $table->string('daily_report_roles')->nullable();
            $table->timestamps();
            $table->time('time')->nullable();

            $table->foreign('company_id', 'log_time_for_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_time_for');
    }
}
