<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLeadboardSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_leadboard_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pipeline_stage_id')->nullable();
            $table->boolean('collapsed')->default(0);
            $table->timestamps();

            $table->foreign('company_id', 'user_leadboard_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pipeline_stage_id', 'user_leadboard_settings_pipeline_stage_id_foreign')->references('id')->on('pipeline_stages')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'user_leadboard_settings_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_leadboard_settings');
    }
}
