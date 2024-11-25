<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_setting', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(0);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->timestamps();
            $table->boolean('ticket_round_robin_status')->default(0);

            $table->foreign('company_id', 'lead_setting_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'lead_setting_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_setting');
    }
}
