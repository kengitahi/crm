<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeaveQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave_quotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('leave_type_id');
            $table->double('no_of_leaves');
            $table->double('leaves_used')->default(0);
            $table->double('leaves_remaining')->default(0);
            $table->timestamps();
            $table->text('carry_forward_status')->nullable();
            $table->boolean('leave_type_impact')->default(0);
            $table->double('overutilised_leaves')->default(0);
            $table->double('unused_leaves')->default(0);
            $table->double('carry_forward_leaves')->default(0);
            $table->double('carry_forward_applied')->default(0);

            $table->foreign('leave_type_id', 'employee_leave_quotas_leave_type_id_foreign')->references('id')->on('leave_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'employee_leave_quotas_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leave_quotas');
    }
}
