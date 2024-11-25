<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('project_name');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->mediumText('project_summary')->nullable();
            $table->longText('notes')->nullable();
            $table->mediumText('feedback')->nullable();
            $table->enum('client_view_task', ['enable', 'disable'])->default('disable');
            $table->enum('allow_client_notification', ['enable', 'disable'])->default('disable');
            $table->enum('manual_timelog', ['enable', 'disable'])->default('disable');
            $table->timestamps();
            $table->integer('added_by')->default(1);

            $table->foreign('category_id', 'project_templates_category_id_foreign')->references('id')->on('project_category')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'project_templates_client_id_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'project_templates_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_templates');
    }
}
