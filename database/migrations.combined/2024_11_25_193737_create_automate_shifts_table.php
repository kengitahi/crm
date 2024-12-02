<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automate_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('employee_shift_rotation_id')->nullable();
            $table->timestamps();

            $table->foreign('employee_shift_rotation_id', 'automate_shifts_employee_shift_rotation_id_foreign')->references('id')->on('employee_shift_rotations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'automate_shifts_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automate_shifts');
    }
}
