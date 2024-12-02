<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->nullable();
            $table->string('original_contract_number')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('project_id')->nullable();
            $table->string('subject');
            $table->string('amount');
            $table->decimal('original_amount', 15, 2);
            $table->unsignedBigInteger('contract_type_id')->nullable();
            $table->date('start_date');
            $table->date('original_start_date');
            $table->date('end_date')->nullable();
            $table->date('original_end_date')->nullable();
            $table->longText('description')->nullable();
            $table->string('contract_name')->nullable();
            $table->string('alternate_address')->nullable();
            $table->text('contract_note')->nullable();
            $table->string('cell')->nullable();
            $table->string('office')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->longText('contract_detail')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('hash')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->text('event_id')->nullable();
            $table->timestamps();
            $table->string('company_sign')->nullable();
            $table->dateTime('sign_date')->nullable();
            $table->unsignedInteger('sign_by')->nullable();

            $table->foreign('added_by', 'contracts_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'contracts_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'contracts_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contract_type_id', 'contracts_contract_type_id_foreign')->references('id')->on('contract_types')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('currency_id', 'contracts_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'contracts_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'contracts_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sign_by', 'contracts_sign_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
