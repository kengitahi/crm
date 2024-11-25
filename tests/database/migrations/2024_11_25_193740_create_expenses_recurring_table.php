<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesRecurringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_recurring', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->string('item_name');
            $table->integer('day_of_month')->default(1);
            $table->integer('day_of_week')->default(1);
            $table->string('payment_method')->nullable();
            $table->enum('rotation', ['monthly', 'weekly', 'bi-weekly', 'quarterly', 'half-yearly', 'annually', 'daily']);
            $table->integer('billing_cycle')->nullable();
            $table->date('issue_date');
            $table->date('next_expense_date')->nullable();
            $table->boolean('unlimited_recurring')->default(0);
            $table->double('price');
            $table->string('bill')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('description')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->string('purchase_from')->nullable();
            $table->boolean('immediate_expense')->default(0);
            $table->timestamps();
            $table->unsignedInteger('bank_account_id')->nullable();

            $table->foreign('added_by', 'expenses_recurring_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('bank_account_id', 'expenses_recurring_bank_account_id_foreign')->references('id')->on('bank_accounts')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('category_id', 'expenses_recurring_category_id_foreign')->references('id')->on('expenses_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'expenses_recurring_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by', 'expenses_recurring_created_by_foreign')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('currency_id', 'expenses_recurring_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'expenses_recurring_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'expenses_recurring_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'expenses_recurring_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_recurring');
    }
}
