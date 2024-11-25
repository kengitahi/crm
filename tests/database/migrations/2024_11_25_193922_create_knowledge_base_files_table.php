<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeBaseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_base_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('knowledge_base_id');
            $table->string('filename', 200)->nullable();
            $table->string('hashname', 200)->nullable();
            $table->string('size', 200)->nullable();
            $table->string('external_link_name')->nullable();
            $table->text('external_link')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'knowledge_base_files_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'knowledge_base_files_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('knowledge_base_id', 'knowledge_base_files_knowledge_base_id_foreign')->references('id')->on('knowledge_bases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'knowledge_base_files_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge_base_files');
    }
}
