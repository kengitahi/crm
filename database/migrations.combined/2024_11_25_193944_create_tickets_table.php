<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('ticket_number')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->text('subject');
            $table->enum('status', ['open', 'pending', 'resolved', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->unsignedInteger('agent_id')->nullable();
            $table->unsignedInteger('channel_id')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->date('close_date')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'tickets_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('agent_id', 'tickets_agent_id_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('channel_id', 'tickets_channel_id_foreign')->references('id')->on('ticket_channels')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'tickets_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id', 'tickets_country_id_foreign')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id', 'tickets_group_id_foreign')->references('id')->on('ticket_groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'tickets_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'tickets_project_id_foreign')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('type_id', 'tickets_type_id_foreign')->references('id')->on('ticket_types')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'tickets_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
