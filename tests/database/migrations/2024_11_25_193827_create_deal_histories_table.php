<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_id');
            $table->string('event_type');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedBigInteger('deal_stage_from_id')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('follow_up_id')->nullable();
            $table->unsignedBigInteger('note_id')->nullable();
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->timestamps();
            $table->unsignedInteger('deal_stage_to_id')->nullable();

            $table->foreign('created_by', 'deal_histories_created_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('deal_id', 'deal_histories_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade');
            $table->foreign('deal_stage_to_id', 'deal_histories_deal_stage_to_id_foreign')->references('id')->on('pipeline_stages')->onDelete('set NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_histories');
    }
}
