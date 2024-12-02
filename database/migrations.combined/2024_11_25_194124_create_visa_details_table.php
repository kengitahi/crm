<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->string('visa_number');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'visa_details_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'visa_details_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id', 'visa_details_country_id_foreign')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'visa_details_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visa_details');
    }
}
