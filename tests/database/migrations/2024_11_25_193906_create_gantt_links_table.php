<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGanttLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gantt_links', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedInteger('source');
            $table->unsignedInteger('target');
            $table->timestamps();

            $table->foreign('project_id', 'gantt_links_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('source', 'gantt_links_source_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('target', 'gantt_links_target_foreign')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gantt_links');
    }
}
