<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceRecurringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_recurring', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->date('issue_date');
            $table->date('next_invoice_date')->nullable();
            $table->date('due_date');
            $table->double('sub_total')->default(0);
            $table->double('total')->default(0);
            $table->double('discount')->default(0);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('file')->nullable();
            $table->string('file_original_name')->nullable();
            $table->text('note')->nullable();
            $table->enum('show_shipping_address', ['yes', 'no'])->default('no');
            $table->integer('day_of_month')->default(1);
            $table->integer('day_of_week')->default(1);
            $table->string('payment_method')->nullable();
            $table->enum('rotation', ['monthly', 'weekly', 'bi-weekly', 'quarterly', 'half-yearly', 'annually', 'daily']);
            $table->integer('billing_cycle')->nullable();
            $table->boolean('client_can_stop')->default(1);
            $table->boolean('unlimited_recurring')->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->text('shipping_address')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->enum('calculate_tax', ['after_discount', 'before_discount'])->default('after_discount');
            $table->timestamps();
            $table->boolean('immediate_invoice')->default(0);
            $table->unsignedInteger('bank_account_id')->nullable();

            $table->foreign('added_by', 'invoice_recurring_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('bank_account_id', 'invoice_recurring_bank_account_id_foreign')->references('id')->on('bank_accounts')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'invoice_recurring_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'invoice_recurring_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by', 'invoice_recurring_created_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('currency_id', 'invoice_recurring_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'invoice_recurring_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'invoice_recurring_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'invoice_recurring_user_id_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_recurring');
    }
}
