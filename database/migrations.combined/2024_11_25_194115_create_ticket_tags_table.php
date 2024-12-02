<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('ticket_id');
            $table->timestamps();

            $table->foreign('company_id', 'ticket_tags_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id', 'ticket_tags_tag_id_foreign')->references('id')->on('ticket_tag_list')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ticket_id', 'ticket_tags_ticket_id_foreign')->references('id')->on('tickets')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_tags');
    }
}
