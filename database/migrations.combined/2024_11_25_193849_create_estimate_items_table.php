<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('estimate_id');
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

            $table->foreign('estimate_id', 'estimate_items_estimate_id_foreign')->references('id')->on('estimates')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'estimate_items_product_id_foreign')->references('id')->on('products')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('unit_id', 'estimate_items_unit_id_foreign')->references('id')->on('unit_types')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimate_items');
    }
}
