<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->string('employee_activity');
            $table->unsignedBigInteger('leave_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('proj_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->unsignedBigInteger('estimate_id')->nullable();
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedBigInteger('deal_followup_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('expenses_id')->nullable();
            $table->unsignedBigInteger('timelog_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('credit_note_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->timestamps();

            $table->foreign('deal_id', 'employee_activity_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_activity');
    }
}
