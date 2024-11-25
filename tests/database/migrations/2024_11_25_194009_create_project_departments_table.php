<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('team_id');
            $table->timestamps();

            $table->foreign('project_id', 'project_departments_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('team_id', 'project_departments_team_id_foreign')->references('id')->on('teams')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_departments');
    }
}
