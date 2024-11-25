<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemovalRequestsLeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('removal_requests_lead', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('lead_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('company_id', 'removal_requests_lead_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lead_id', 'removal_requests_lead_lead_id_foreign')->references('id')->on('leads')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('removal_requests_lead');
    }
}
