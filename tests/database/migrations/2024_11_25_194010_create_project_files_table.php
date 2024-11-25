<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->string('filename');
            $table->string('hashname')->nullable();
            $table->string('size')->nullable();
            $table->text('description')->nullable();
            $table->string('google_url')->nullable();
            $table->string('dropbox_link')->nullable();
            $table->string('external_link_name')->nullable();
            $table->text('external_link')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'project_files_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'project_files_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'project_files_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'project_files_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'project_files_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_files');
    }
}
