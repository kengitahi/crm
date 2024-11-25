<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePipelineStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipeline_stages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('lead_pipeline_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('default')->default(0);
            $table->string('label_color')->default('#ff0000');
            $table->timestamps();

            $table->foreign('company_id', 'pipeline_stages_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lead_pipeline_id', 'pipeline_stages_lead_pipeline_id_foreign')->references('id')->on('lead_pipelines')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pipeline_stages');
    }
}
