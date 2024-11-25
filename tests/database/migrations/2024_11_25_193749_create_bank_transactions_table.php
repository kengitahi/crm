<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('bank_account_id')->nullable();
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
            $table->unsignedInteger('expense_id')->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->enum('type', ['Cr', 'Dr'])->default('Cr');
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('memo')->nullable();
            $table->string('transaction_relation')->nullable();
            $table->string('transaction_related_to')->nullable();
            $table->text('title')->nullable();
            $table->date('transaction_date')->nullable();
            $table->double('bank_balance', 16, 2)->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'bank_transactions_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('bank_account_id', 'bank_transactions_bank_account_id_foreign')->references('id')->on('bank_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'bank_transactions_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expense_id', 'bank_transactions_expense_id_foreign')->references('id')->on('expenses')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('invoice_id', 'bank_transactions_invoice_id_foreign')->references('id')->on('invoices')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'bank_transactions_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('payment_id', 'bank_transactions_payment_id_foreign')->references('id')->on('payments')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_transactions');
    }
}
