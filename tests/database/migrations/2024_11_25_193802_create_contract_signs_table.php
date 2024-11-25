<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_signs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('contract_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('signature');
            $table->timestamps();
            $table->string('place')->nullable();
            $table->string('date')->nullable();

            $table->foreign('company_id', 'contract_signs_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contract_id', 'contract_signs_contract_id_foreign')->references('id')->on('contracts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_signs');
    }
}
