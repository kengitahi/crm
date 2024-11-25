<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadFollowUpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_follow_up', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->longText('remark')->nullable();
            $table->dateTime('next_follow_up_date')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('event_id')->nullable();
            $table->enum('send_reminder', ['yes', 'no'])->default('no');
            $table->text('remind_time')->nullable();
            $table->enum('remind_type', ['minute', 'hour', 'day'])->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'lead_follow_up_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('deal_id', 'lead_follow_up_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'lead_follow_up_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_follow_up');
    }
}
