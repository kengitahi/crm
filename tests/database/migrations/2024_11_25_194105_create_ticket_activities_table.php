<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->unsignedInteger('channel_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->string('status')->default('open');
            $table->string('priority')->default('medium');
            $table->string('type')->default('create');
            $table->longText('content')->nullable();
            $table->timestamps();

            $table->foreign('assigned_to', 'ticket_activities_assigned_to_foreign')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('channel_id', 'ticket_activities_channel_id_foreign')->references('id')->on('ticket_channels')->onDelete('cascade');
            $table->foreign('group_id', 'ticket_activities_group_id_foreign')->references('id')->on('ticket_groups')->onDelete('cascade');
            $table->foreign('ticket_id', 'ticket_activities_ticket_id_foreign')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('type_id', 'ticket_activities_type_id_foreign')->references('id')->on('ticket_types')->onDelete('cascade');
            $table->foreign('user_id', 'ticket_activities_user_id_foreign')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_activities');
    }
}
