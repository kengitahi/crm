<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable();
            $table->string('title');
            $table->boolean('type')->default(0);
            $table->unsignedInteger('client_id')->nullable();
            $table->boolean('is_client_show')->default(0);
            $table->boolean('ask_password')->default(0);
            $table->longText('details');
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'project_notes_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'project_notes_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'project_notes_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'project_notes_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_notes');
    }
}
