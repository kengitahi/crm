<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceRecurringItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_recurring_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('invoice_recurring_id');
            $table->string('item_name');
            $table->double('quantity');
            $table->double('unit_price');
            $table->double('amount');
            $table->text('taxes')->nullable();
            $table->enum('type', ['item', 'discount', 'tax'])->default('item');
            $table->text('item_summary')->nullable();
            $table->string('hsn_sac_code')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();

            $table->foreign('invoice_recurring_id', 'invoice_recurring_items_invoice_recurring_id_foreign')->references('id')->on('invoice_recurring')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'invoice_recurring_items_product_id_foreign')->references('id')->on('products')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('unit_id', 'invoice_recurring_items_unit_id_foreign')->references('id')->on('unit_types')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_recurring_items');
    }
}
