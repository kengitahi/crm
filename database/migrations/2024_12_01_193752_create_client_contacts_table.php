<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('client_contacts')) {
            Schema::create('client_contacts', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->nullable();
                $table->unsignedInteger('user_id');
                $table->uuid('contact_id');
                $table->string('contact_name');
                // $table->string('phone')->nullable();
                $table->string('email');
                // $table->string('title')->nullable();
                $table->unsignedInteger('added_by')->nullable();
                $table->unsignedInteger('last_updated_by')->nullable();
                $table->timestamps();

                $table->foreign('added_by', 'client_contacts_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
                $table->foreign('company_id', 'client_contacts_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('last_updated_by', 'client_contacts_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
                $table->foreign('user_id', 'client_contacts_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_contacts');
    }
}
