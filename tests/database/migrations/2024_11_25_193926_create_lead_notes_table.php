<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id')->nullable();
            $table->string('title');
            $table->boolean('type')->default(0);
            $table->unsignedInteger('member_id')->nullable();
            $table->boolean('is_lead_show')->default(0);
            $table->boolean('ask_password')->default(0);
            $table->text('details')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'lead_notes_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'lead_notes_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('lead_id', 'lead_notes_lead_id_foreign')->references('id')->on('leads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('member_id', 'lead_notes_member_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_notes');
    }
}
