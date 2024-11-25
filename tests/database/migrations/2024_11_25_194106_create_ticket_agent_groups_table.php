<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketAgentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_agent_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('agent_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->enum('status', ['enabled', 'disabled'])->default('enabled');
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'ticket_agent_groups_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('agent_id', 'ticket_agent_groups_agent_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'ticket_agent_groups_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id', 'ticket_agent_groups_group_id_foreign')->references('id')->on('ticket_groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'ticket_agent_groups_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_agent_groups');
    }
}
