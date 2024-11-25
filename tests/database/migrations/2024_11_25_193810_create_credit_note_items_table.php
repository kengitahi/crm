<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('credit_note_id');
            $table->string('item_name');
            $table->enum('type', ['item', 'discount', 'tax'])->default('item');
            $table->integer('quantity');
            $table->double('unit_price', 30, 2);
            $table->double('amount', 30, 2);
            $table->string('taxes')->nullable();
            $table->string('hsn_sac_code')->nullable();
            $table->text('item_summary')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();

            $table->foreign('credit_note_id', 'credit_note_items_credit_note_id_foreign')->references('id')->on('credit_notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'credit_note_items_product_id_foreign')->references('id')->on('products')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('unit_id', 'credit_note_items_unit_id_foreign')->references('id')->on('unit_types')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_note_items');
    }
}
