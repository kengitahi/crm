<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeShiftRotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_shift_rotations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('rotation_name')->nullable();
            $table->string('rotation_frequency')->nullable();
            $table->string('schedule_on')->nullable();
            $table->integer('rotation_date')->nullable();
            $table->string('color_code')->nullable();
            $table->enum('override_shift', ['yes', 'no'])->default('no');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->enum('send_mail', ['yes', 'no'])->default('yes');

            $table->foreign('company_id', 'employee_shift_rotations_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_shift_rotations');
    }
}
