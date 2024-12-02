<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceRecurringItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_recurring_item_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_recurring_item_id');
            $table->string('filename');
            $table->string('hashname')->nullable();
            $table->string('size')->nullable();
            $table->string('external_link')->nullable();
            $table->timestamps();

            $table->foreign('invoice_recurring_item_id', 'invoice_recurring_item_images_invoice_recurring_item_id_foreign')->references('id')->on('invoice_recurring_items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_recurring_item_images');
    }
}
