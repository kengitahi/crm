<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->string('item_name');
            $table->text('item_summary')->nullable();
            $table->enum('type', ['item', 'discount', 'tax'])->default('item');
            $table->double('quantity', 30, 2);
            $table->double('unit_price', 30, 2);
            $table->double('amount', 30, 2);
            $table->string('taxes')->nullable();
            $table->string('hsn_sac_code')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('field_order')->default(0);

            $table->foreign('invoice_id', 'invoice_items_invoice_id_foreign')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'invoice_items_product_id_foreign')->references('id')->on('products')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('unit_id', 'invoice_items_unit_id_foreign')->references('id')->on('unit_types')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
