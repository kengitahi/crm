<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleCalendarModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_calendar_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->boolean('lead_status')->default(0);
            $table->boolean('leave_status')->default(0);
            $table->boolean('invoice_status')->default(0);
            $table->boolean('contract_status')->default(0);
            $table->boolean('task_status')->default(0);
            $table->boolean('event_status')->default(0);
            $table->boolean('holiday_status')->default(0);
            $table->timestamps();

            $table->foreign('company_id', 'google_calendar_modules_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_calendar_modules');
    }
}
