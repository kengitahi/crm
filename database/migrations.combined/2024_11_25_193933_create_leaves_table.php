<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('leave_type_id');
            $table->string('unique_id')->nullable();
            $table->string('duration');
            $table->date('leave_date')->index('leaves_leave_date_index');
            $table->text('reason');
            $table->enum('status', ['approved', 'pending', 'rejected']);
            $table->text('reject_reason')->nullable();
            $table->boolean('paid')->default(0);
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('event_id')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('half_day_type')->nullable();
            $table->timestamps();
            $table->enum('manager_status_permission', ['pre-approve', 'approved'])->nullable();
            $table->text('approve_reason')->nullable();
            $table->boolean('over_utilized')->default(0);

            $table->foreign('added_by', 'leaves_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('approved_by', 'leaves_approved_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'leaves_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'leaves_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('leave_type_id', 'leaves_leave_type_id_foreign')->references('id')->on('leave_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'leaves_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
