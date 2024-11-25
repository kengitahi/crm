<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('source_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('column_priority');
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->enum('salutation', ['mr', 'mrs', 'miss', 'dr', 'sir', 'madam'])->nullable();
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('cell')->nullable();
            $table->string('office')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('note')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->integer('lead_owner')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('hash')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'leads_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('category_id', 'leads_category_id_foreign')->references('id')->on('lead_category')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'leads_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'leads_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
