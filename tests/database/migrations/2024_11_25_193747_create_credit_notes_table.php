<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->string('cn_number');
            $table->string('original_credit_note_number')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
            $table->date('issue_date');
            $table->date('due_date');
            $table->double('discount')->default(0);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->double('sub_total', 15, 2);
            $table->double('total', 15, 2);
            $table->double('adjustment_amount', 30, 2)->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->enum('status', ['closed', 'open'])->default('open');
            $table->enum('recurring', ['yes', 'no'])->default('no');
            $table->string('billing_frequency')->nullable();
            $table->integer('billing_interval')->nullable();
            $table->integer('billing_cycle')->nullable();
            $table->string('file')->nullable();
            $table->string('file_original_name')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->enum('calculate_tax', ['after_discount', 'before_discount'])->default('after_discount');
            $table->timestamps();

            $table->foreign('added_by', 'credit_notes_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'credit_notes_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'credit_notes_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'credit_notes_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'credit_notes_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'credit_notes_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_notes');
    }
}
