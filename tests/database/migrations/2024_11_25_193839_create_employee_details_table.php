<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('employee_id')->nullable();
            $table->text('address')->nullable();
            $table->double('hourly_rate')->nullable();
            $table->string('slack_username')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->timestamp('joining_date')->default('current_timestamp()');
            $table->date('last_date')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->date('attendance_reminder')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('calendar_view')->nullable();
            $table->text('about_me')->nullable();
            $table->unsignedInteger('reporting_to')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->date('internship_end_date')->nullable();
            $table->string('employment_type')->nullable();
            $table->date('marriage_anniversary_date')->nullable();
            $table->string('marital_status')->default('single');
            $table->date('notice_period_end_date')->nullable();
            $table->date('notice_period_start_date')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('company_address_id')->nullable();

            $table->unique(['employee_id', 'company_id'], 'employee_details_employee_id_company_id_unique');
            $table->unique(['slack_username', 'company_id'], 'employee_details_slack_username_company_id_unique');
            $table->foreign('added_by', 'employee_details_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_address_id', 'employee_details_company_address_id_foreign')->references('id')->on('company_addresses')->onDelete('set NULL');
            $table->foreign('company_id', 'employee_details_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id', 'employee_details_department_id_foreign')->references('id')->on('teams')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('designation_id', 'employee_details_designation_id_foreign')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'employee_details_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('reporting_to', 'employee_details_reporting_to_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'employee_details_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_details');
    }
}
