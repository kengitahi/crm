<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('currency_name');
            $table->string('currency_symbol')->nullable();
            $table->string('currency_code');
            $table->double('exchange_rate')->nullable();
            $table->enum('is_cryptocurrency', ['yes', 'no'])->default('no');
            $table->double('usd_price')->nullable();
            $table->timestamps();
            $table->enum('currency_position', ['left', 'right', 'left_with_space', 'right_with_space'])->default('left');
            $table->unsignedInteger('no_of_decimal');
            $table->string('thousand_separator')->nullable();
            $table->string('decimal_separator')->nullable();

            $table->foreign('company_id', 'currencies_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
