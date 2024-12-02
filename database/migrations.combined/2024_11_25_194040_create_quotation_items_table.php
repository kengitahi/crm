<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->string('item_name');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->double('amount', 30, 2);
            $table->string('hsn_sac_code')->nullable();
            $table->timestamps();

            $table->foreign('quotation_id', 'quotation_items_quotation_id_foreign')->references('id')->on('quotations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_items');
    }
}
