<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->enum('allow_client_admin', ['yes', 'no'])->default('no');
            $table->enum('allow_client_employee', ['yes', 'no'])->default('no');
            $table->enum('restrict_client', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->boolean('send_sound_notification')->default(0);

            $table->foreign('company_id', 'message_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_settings');
    }
}
