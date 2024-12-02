<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_requests', function (Blueprint $table) {
            $table->id();
            $table->string('original_request_number')->nullable();
            $table->string('estimate_request_number')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('estimate_id')->nullable();
            $table->longText('description');
            $table->double('estimated_budget', 16, 2);
            $table->unsignedInteger('project_id')->nullable();
            $table->text('early_requirement')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->enum('status', ['pending', 'rejected', 'accepted', 'in process'])->default('pending');
            $table->text('reason');
            $table->timestamps();
            $table->unsignedInteger('added_by')->nullable();

            $table->foreign('added_by', 'estimate_requests_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'estimate_requests_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'estimate_requests_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'estimate_requests_currency_id_foreign')->references('id')->on('currencies')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('estimate_id', 'estimate_requests_estimate_id_foreign')->references('id')->on('estimates')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id', 'estimate_requests_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_requests');
    }
}
