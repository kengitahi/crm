<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_templates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contract_template_number')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('subject');
            $table->longText('description')->nullable();
            $table->string('amount');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedInteger('currency_id')->nullable();
            $table->longText('contract_detail')->nullable();
            $table->integer('added_by')->default(1);
            $table->timestamps();

            $table->foreign('company_id', 'contract_templates_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contract_type_id', 'contract_templates_contract_type_id_foreign')->references('id')->on('contract_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'contract_templates_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_templates');
    }
}
