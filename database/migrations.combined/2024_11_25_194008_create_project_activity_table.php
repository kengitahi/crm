<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->text('activity');
            $table->timestamps();

            $table->index(['created_at'], 'project_activity_created_at_index');
            $table->foreign('project_id', 'project_activity_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_activity');
    }
}
