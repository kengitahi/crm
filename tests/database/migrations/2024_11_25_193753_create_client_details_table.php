<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('company_name')->nullable();
            $table->text('address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('office')->nullable();
            $table->string('website')->nullable();
            $table->text('note')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('skype')->nullable();
            $table->string('tax_name')->nullable();
            $table->string('gst_number')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->string('company_logo')->nullable();
            $table->timestamps();
            $table->integer('quickbooks_client_id')->nullable();
            $table->string('electronic_address')->nullable();
            $table->string('electronic_address_scheme')->nullable();

            $table->foreign('added_by', 'client_details_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('category_id', 'client_details_category_id_foreign')->references('id')->on('client_categories')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'client_details_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'client_details_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('sub_category_id', 'client_details_sub_category_id_foreign')->references('id')->on('client_sub_categories')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'client_details_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_details');
    }
}
