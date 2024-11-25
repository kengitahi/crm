<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadPipelineStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_pipeline_stages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lead_pipeline_id')->nullable();
            $table->unsignedInteger('pipeline_stages_id')->nullable();
            $table->timestamps();

            $table->foreign('lead_pipeline_id', 'lead_pipeline_stages_lead_pipeline_id_foreign')->references('id')->on('lead_pipelines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pipeline_stages_id', 'lead_pipeline_stages_pipeline_stages_id_foreign')->references('id')->on('pipeline_stages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_pipeline_stages');
    }
}
