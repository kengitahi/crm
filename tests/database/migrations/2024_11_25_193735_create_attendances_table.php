<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->dateTime('clock_in_time')->index('attendances_clock_in_time_index');
            $table->dateTime('clock_out_time')->nullable()->index('attendances_clock_out_time_index');
            $table->boolean('auto_clock_out')->default(0);
            $table->string('clock_in_ip');
            $table->string('clock_out_ip')->nullable();
            $table->string('working_from')->default('office');
            $table->enum('late', ['yes', 'no'])->default('no');
            $table->enum('half_day', ['yes', 'no']);
            $table->string('half_day_type')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->dateTime('shift_start_time')->nullable();
            $table->dateTime('shift_end_time')->nullable();
            $table->unsignedBigInteger('employee_shift_id')->nullable();
            $table->timestamps();
            $table->enum('work_from_type', ['home', 'office', 'other'])->default('other');
            $table->enum('overwrite_attendance', ['yes', 'no'])->default('no');

            $table->foreign('added_by', 'attendances_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'attendances_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_shift_id', 'attendances_employee_shift_id_foreign')->references('id')->on('employee_shifts')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'attendances_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('location_id', 'attendances_location_id_foreign')->references('id')->on('company_addresses')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'attendances_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
