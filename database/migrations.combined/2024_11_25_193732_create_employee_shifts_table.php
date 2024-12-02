<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('shift_name');
            $table->string('shift_short_code');
            $table->enum('shift_type', ['strict', 'flexible'])->default('strict');
            $table->double('flexible_total_hours')->nullable();
            $table->double('flexible_auto_clockout')->nullable();
            $table->double('flexible_half_day_hours')->nullable();
            $table->string('color');
            $table->time('office_start_time');
            $table->time('office_end_time');
            $table->integer('auto_clock_out_time')->default(1);
            $table->time('halfday_mark_time')->nullable();
            $table->tinyInteger('late_mark_duration');
            $table->tinyInteger('clockin_in_day');
            $table->text('office_open_days');
            $table->timestamps();
            $table->string('early_clock_in')->nullable();

            $table->foreign('company_id', 'employee_shifts_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_shifts');
    }
}
