<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('column_priority')->default(0);
            $table->unsignedBigInteger('lead_pipeline_id')->nullable();
            $table->unsignedInteger('pipeline_stage_id')->nullable();
            $table->unsignedInteger('lead_id')->nullable();
            $table->date('close_date')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->enum('next_follow_up', ['yes', 'no'])->default('yes');
            $table->double('value', 30, 2)->default(0.00);
            $table->longText('note')->nullable();
            $table->text('hash')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();
            $table->integer('deal_watcher')->nullable();

            $table->foreign('added_by', 'deals_added_by_foreign')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agent_id', 'deals_agent_id_foreign')->references('id')->on('lead_agents')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('category_id', 'deals_category_id_foreign')->references('id')->on('lead_category')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'deals_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'deals_currency_id_foreign')->references('id')->on('currencies')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'deals_last_updated_by_foreign')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lead_id', 'deals_lead_id_foreign')->references('id')->on('leads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lead_pipeline_id', 'deals_lead_pipeline_id_foreign')->references('id')->on('lead_pipelines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pipeline_stage_id', 'deals_pipeline_stage_id_foreign')->references('id')->on('pipeline_stages')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
