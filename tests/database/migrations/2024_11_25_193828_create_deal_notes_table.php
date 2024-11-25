<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'deal_notes_added_by_foreign')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deal_id', 'deal_notes_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'deal_notes_last_updated_by_foreign')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_notes');
    }
}
