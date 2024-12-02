<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('previous_designation_id')->nullable();
            $table->unsignedBigInteger('current_designation_id')->nullable();
            $table->enum('send_notification', ['yes', 'no'])->default('no');
            $table->unsignedInteger('previous_department_id')->nullable();
            $table->unsignedInteger('current_department_id')->nullable();
            $table->timestamps();

            $table->foreign('company_id', 'promotions_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('current_department_id', 'promotions_current_department_id_foreign')->references('id')->on('teams')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('current_designation_id', 'promotions_current_designation_id_foreign')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id', 'promotions_employee_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('previous_department_id', 'promotions_previous_department_id_foreign')->references('id')->on('teams')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('previous_designation_id', 'promotions_previous_designation_id_foreign')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
