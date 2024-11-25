<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('client_id');
            $table->string('estimate_number')->nullable();
            $table->string('original_estimate_number')->nullable();
            $table->date('valid_till');
            $table->double('sub_total', 30, 2);
            $table->double('discount')->default(0);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->double('total', 30, 2);
            $table->unsignedInteger('currency_id')->nullable();
            $table->enum('status', ['declined', 'accepted', 'waiting', 'sent', 'draft', 'canceled'])->default('waiting');
            $table->mediumText('note')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('send_status')->default(1);
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('hash')->nullable();
            $table->enum('calculate_tax', ['after_discount', 'before_discount'])->default('after_discount');
            $table->timestamps();
            $table->timestamp('last_viewed')->nullable();
            $table->string('ip_address')->nullable();
            $table->unsignedBigInteger('estimate_request_id')->nullable();

            $table->unique(['estimate_number', 'company_id'], 'estimates_estimate_number_company_id_unique');
            $table->foreign('added_by', 'estimates_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'estimates_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'estimates_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'estimates_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estimate_request_id', 'estimates_estimate_request_id_foreign')->references('id')->on('estimate_requests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'estimates_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimates');
    }
}
