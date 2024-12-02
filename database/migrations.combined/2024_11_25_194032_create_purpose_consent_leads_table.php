<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurposeConsentLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purpose_consent_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedInteger('purpose_consent_id');
            $table->enum('status', ['agree', 'disagree'])->default('agree');
            $table->string('ip')->nullable();
            $table->unsignedInteger('updated_by_id')->nullable();
            $table->text('additional_description')->nullable();
            $table->timestamps();

            $table->foreign('deal_id', 'purpose_consent_leads_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('purpose_consent_id', 'purpose_consent_leads_purpose_consent_id_foreign')->references('id')->on('purpose_consent')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by_id', 'purpose_consent_leads_updated_by_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purpose_consent_leads');
    }
}
