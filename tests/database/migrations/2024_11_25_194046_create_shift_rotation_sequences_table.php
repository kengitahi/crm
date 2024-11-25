<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftRotationSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_rotation_sequences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_shift_rotation_id')->nullable();
            $table->unsignedBigInteger('employee_shift_id')->nullable();
            $table->integer('sequence')->nullable();
            $table->timestamps();

            $table->foreign('employee_shift_id', 'shift_rotation_sequences_employee_shift_id_foreign')->references('id')->on('employee_shifts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_shift_rotation_id', 'shift_rotation_sequences_employee_shift_rotation_id_foreign')->references('id')->on('employee_shift_rotations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_rotation_sequences');
    }
}
