<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeShiftSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_shift_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->date('date')->index('employee_shift_schedules_date_index');
            $table->unsignedBigInteger('employee_shift_id');
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->dateTime('shift_start_time')->nullable();
            $table->dateTime('shift_end_time')->nullable();
            $table->text('remarks')->nullable();
            $table->string('file');
            $table->timestamps();

            $table->foreign('added_by', 'employee_shift_schedules_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('employee_shift_id', 'employee_shift_schedules_employee_shift_id_foreign')->references('id')->on('employee_shifts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'employee_shift_schedules_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'employee_shift_schedules_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_shift_schedules');
    }
}
