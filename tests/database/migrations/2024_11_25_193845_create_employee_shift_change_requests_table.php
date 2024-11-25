<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeShiftChangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_shift_change_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('shift_schedule_id');
            $table->unsignedBigInteger('employee_shift_id');
            $table->enum('status', ['waiting', 'accepted', 'rejected'])->default('waiting');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->foreign('company_id', 'employee_shift_change_requests_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_shift_id', 'employee_shift_change_requests_employee_shift_id_foreign')->references('id')->on('employee_shifts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('shift_schedule_id', 'employee_shift_change_requests_shift_schedule_id_foreign')->references('id')->on('employee_shift_schedules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_shift_change_requests');
    }
}
