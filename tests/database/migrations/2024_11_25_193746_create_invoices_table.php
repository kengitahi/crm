<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('invoice_number');
            $table->string('original_invoice_number')->nullable();
            $table->date('issue_date');
            $table->date('due_date')->index('invoices_due_date_index');
            $table->double('sub_total', 30, 2);
            $table->double('discount')->default(0);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->double('total', 30, 2);
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('default_currency_id')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->enum('status', ['paid', 'unpaid', 'partial', 'canceled', 'draft', 'pending-confirmation'])->default('unpaid');
            $table->enum('recurring', ['yes', 'no'])->default('no');
            $table->integer('billing_cycle')->nullable();
            $table->integer('billing_interval')->nullable();
            $table->string('billing_frequency')->nullable();
            $table->string('file')->nullable();
            $table->string('file_original_name')->nullable();
            $table->text('note')->nullable();
            $table->boolean('credit_note')->default(0);
            $table->enum('show_shipping_address', ['yes', 'no'])->default('no');
            $table->unsignedInteger('estimate_id')->nullable();
            $table->boolean('send_status')->default(1);
            $table->double('due_amount')->default(0);
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedBigInteger('invoice_recurring_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('hash')->nullable();
            $table->enum('calculate_tax', ['after_discount', 'before_discount'])->default('after_discount');
            $table->unsignedBigInteger('company_address_id')->nullable();
            $table->text('event_id')->nullable();
            $table->string('custom_invoice_number')->nullable();
            $table->enum('payment_status', ['1', '0'])->default('0');
            $table->unsignedInteger('offline_method_id')->nullable();
            $table->string('transaction_id')->nullable()->unique('invoices_transaction_id_unique');
            $table->unsignedBigInteger('invoice_payment_id')->nullable();
            $table->string('gateway')->nullable();
            $table->timestamps();
            $table->unsignedInteger('bank_account_id')->nullable();
            $table->timestamp('last_viewed')->nullable();
            $table->string('ip_address')->nullable();
            $table->integer('quickbooks_invoice_id')->nullable();

            $table->unique(['invoice_number', 'company_id'], 'invoices_invoice_number_company_id_unique');
            $table->foreign('added_by', 'invoices_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('bank_account_id', 'invoices_bank_account_id_foreign')->references('id')->on('bank_accounts')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'invoices_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_address_id', 'invoices_company_address_id_foreign')->references('id')->on('company_addresses')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'invoices_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by', 'invoices_created_by_foreign')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('currency_id', 'invoices_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('default_currency_id', 'invoices_default_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estimate_id', 'invoices_estimate_id_foreign')->references('id')->on('estimates')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_payment_id', 'invoices_invoice_payment_id_foreign')->references('id')->on('invoice_payment_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_recurring_id', 'invoices_invoice_recurring_id_foreign')->references('id')->on('invoice_recurring')->onDelete('set NULL');
            $table->foreign('last_updated_by', 'invoices_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('offline_method_id', 'invoices_offline_method_id_foreign')->references('id')->on('offline_payment_methods')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('order_id', 'invoices_order_id_foreign')->references('id')->on('orders')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('parent_id', 'invoices_parent_id_foreign')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id', 'invoices_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
