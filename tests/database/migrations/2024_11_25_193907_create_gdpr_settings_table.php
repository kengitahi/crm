<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGdprSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gdpr_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enable_gdpr')->default(0);
            $table->boolean('show_customer_area')->default(0);
            $table->boolean('show_customer_footer')->default(0);
            $table->longText('top_information_block')->nullable();
            $table->boolean('enable_export')->default(0);
            $table->boolean('data_removal')->default(0);
            $table->boolean('lead_removal_public_form')->default(0);
            $table->boolean('terms_customer_footer')->default(0);
            $table->longText('terms')->nullable();
            $table->longText('policy')->nullable();
            $table->boolean('public_lead_edit')->default(0);
            $table->boolean('consent_customer')->default(0);
            $table->boolean('consent_leads')->default(0);
            $table->longText('consent_block')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gdpr_settings');
    }
}
