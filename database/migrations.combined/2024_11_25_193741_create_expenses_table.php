<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('item_name');
            $table->date('purchase_date');
            $table->string('purchase_from')->nullable();
            $table->double('price')->nullable();
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('default_currency_id')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->string('bill')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('can_claim')->default(1);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('expenses_recurring_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->unsignedInteger('approver_id')->nullable();
            $table->timestamps();
            $table->unsignedInteger('bank_account_id')->nullable();

            $table->foreign('added_by', 'expenses_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('approver_id', 'expenses_approver_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bank_account_id', 'expenses_bank_account_id_foreign')->references('id')->on('bank_accounts')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('category_id', 'expenses_category_id_foreign')->references('id')->on('expenses_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'expenses_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by', 'expenses_created_by_foreign')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('currency_id', 'expenses_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('default_currency_id', 'expenses_default_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expenses_recurring_id', 'expenses_expenses_recurring_id_foreign')->references('id')->on('expenses_recurring')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'expenses_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'expenses_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
