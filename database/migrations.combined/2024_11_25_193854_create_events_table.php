<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('event_name');
            $table->string('label_color');
            $table->string('where');
            $table->mediumText('description');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->unsignedInteger('host')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->string('note');
            $table->enum('repeat', ['yes', 'no'])->default('no');
            $table->integer('repeat_every')->nullable();
            $table->integer('repeat_cycles')->nullable();
            $table->enum('repeat_type', ['day', 'week', 'month', 'year'])->default('day');
            $table->enum('send_reminder', ['yes', 'no'])->default('no');
            $table->integer('remind_time')->nullable();
            $table->enum('remind_type', ['day', 'hour', 'minute'])->default('day');
            $table->string('event_link')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('event_id')->nullable();
            $table->timestamps();
            $table->text('departments')->nullable();

            $table->foreign('added_by', 'events_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'events_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('host', 'events_host_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'events_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('parent_id', 'events_parent_id_foreign')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
