<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('type_name');
            $table->string('color');
            $table->double('no_of_leaves')->default(5);
            $table->boolean('paid')->default(1);
            $table->decimal('monthly_limit', 10, 2)->default(0.00);
            $table->integer('effective_after')->nullable();
            $table->string('effective_type')->nullable();
            $table->string('unused_leave')->nullable();
            $table->tinyInteger('encashed');
            $table->tinyInteger('allowed_probation');
            $table->tinyInteger('allowed_notice');
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->longText('department')->nullable();
            $table->longText('designation')->nullable();
            $table->longText('role')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->enum('leavetype', ['monthly', 'yearly'])->nullable();
            $table->enum('over_utilization', ['not_allowed', 'allow_paid', 'allow_unpaid'])->default('not_allowed');

            $table->foreign('company_id', 'leave_types_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}
