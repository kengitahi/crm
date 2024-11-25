<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRotationAutomateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rotation_automate_log', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('employee_shift_rotation_id')->nullable();
            $table->unsignedBigInteger('employee_shift_id')->nullable();
            $table->integer('sequence')->nullable();
            $table->date('cron_run_date')->nullable();
            $table->timestamps();

            $table->foreign('company_id', 'rotation_automate_log_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_shift_id', 'rotation_automate_log_employee_shift_id_foreign')->references('id')->on('employee_shifts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_shift_rotation_id', 'rotation_automate_log_employee_shift_rotation_id_foreign')->references('id')->on('employee_shift_rotations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'rotation_automate_log_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rotation_automate_log');
    }
}
