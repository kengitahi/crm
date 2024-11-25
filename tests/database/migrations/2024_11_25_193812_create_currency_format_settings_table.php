<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyFormatSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_format_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->enum('currency_position', ['left', 'right', 'left_with_space', 'right_with_space'])->default('left');
            $table->unsignedInteger('no_of_decimal');
            $table->string('thousand_separator')->nullable();
            $table->string('decimal_separator')->nullable();

            $table->foreign('company_id', 'currency_format_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_format_settings');
    }
}
