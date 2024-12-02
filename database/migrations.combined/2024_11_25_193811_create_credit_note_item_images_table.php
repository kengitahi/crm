<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNoteItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_item_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('credit_note_item_id');
            $table->string('filename')->nullable();
            $table->string('hashname')->nullable();
            $table->string('size')->nullable();
            $table->string('external_link')->nullable();
            $table->timestamps();

            $table->foreign('credit_note_item_id', 'credit_note_item_images_credit_note_item_id_foreign')->references('id')->on('credit_note_items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_note_item_images');
    }
}
