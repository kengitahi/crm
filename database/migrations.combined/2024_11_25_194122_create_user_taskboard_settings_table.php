<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTaskboardSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_taskboard_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('board_column_id');
            $table->boolean('collapsed')->default(0);
            $table->timestamps();

            $table->foreign('board_column_id', 'user_taskboard_settings_board_column_id_foreign')->references('id')->on('taskboard_columns')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'user_taskboard_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'user_taskboard_settings_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_taskboard_settings');
    }
}
