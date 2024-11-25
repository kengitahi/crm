<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_bases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('to')->default('employee');
            $table->string('heading')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->mediumText('description')->nullable();
            $table->unsignedInteger('added_by');
            $table->timestamps();

            $table->foreign('category_id', 'knowledge_bases_category_id_foreign')->references('id')->on('knowledge_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'knowledge_bases_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge_bases');
    }
}
