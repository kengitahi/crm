<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketCustomFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_custom_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('custom_fields_id')->nullable();
            $table->string('field_display_name');
            $table->string('field_name');
            $table->string('field_type')->default('text');
            $table->integer('field_order');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('required')->default(0);
            $table->timestamps();

            $table->foreign('company_id', 'ticket_custom_forms_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('custom_fields_id', 'ticket_custom_forms_custom_fields_id_foreign')->references('id')->on('custom_fields')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_custom_forms');
    }
}
