<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->string('external_link')->nullable();
            $table->timestamps();

            $table->foreign('order_item_id', 'order_item_images_order_item_id_foreign')->references('id')->on('order_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item_images');
    }
}
