<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedInteger('credit_notes_id')->nullable();
            $table->double('amount');
            $table->string('gateway')->nullable();
            $table->string('transaction_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('default_currency_id')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->string('plan_id')->nullable()->unique('payments_plan_id_unique');
            $table->string('customer_id')->nullable();
            $table->string('event_id')->nullable();
            $table->enum('status', ['complete', 'pending', 'failed'])->default('pending');
            $table->dateTime('paid_on')->nullable()->index('payments_paid_on_index');
            $table->text('remarks')->nullable();
            $table->unsignedInteger('offline_method_id')->nullable();
            $table->string('bill')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('payment_gateway_response')->nullable()->comment('null = success');
            $table->string('payload_id')->nullable();
            $table->timestamps();
            $table->unsignedInteger('bank_account_id')->nullable();
            $table->integer('quickbooks_payment_id')->nullable();

            $table->unique(['event_id', 'company_id'], 'payments_event_id_company_id_unique');
            $table->unique(['transaction_id', 'company_id'], 'payments_transaction_id_company_id_unique');
            $table->foreign('added_by', 'payments_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('bank_account_id', 'payments_bank_account_id_foreign')->references('id')->on('bank_accounts')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'payments_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('credit_notes_id', 'payments_credit_notes_id_foreign')->references('id')->on('credit_notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'payments_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('default_currency_id', 'payments_default_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id', 'payments_invoice_id_foreign')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'payments_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('offline_method_id', 'payments_offline_method_id_foreign')->references('id')->on('offline_payment_methods')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('order_id', 'payments_order_id_foreign')->references('id')->on('orders')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'payments_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
