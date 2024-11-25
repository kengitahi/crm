<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('panel');
            $table->string('header_color');
            $table->string('sidebar_color');
            $table->string('sidebar_text_color');
            $table->string('link_color')->default('#ffffff');
            $table->longText('user_css')->nullable();
            $table->enum('sidebar_theme', ['dark', 'light'])->default('dark');
            $table->timestamps();

            $table->foreign('company_id', 'theme_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_settings');
    }
}
