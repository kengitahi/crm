<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_email_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('mail_from_email')->nullable();
            $table->string('imap_host')->nullable();
            $table->string('imap_port')->nullable();
            $table->string('imap_encryption')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('verified');
            $table->integer('sync_interval')->default(1);
            $table->timestamps();

            $table->foreign('company_id', 'ticket_email_settings_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_email_settings');
    }
}
