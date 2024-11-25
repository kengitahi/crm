<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversalSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universal_search', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->integer('searchable_id');
            $table->enum('module_type', ['ticket', 'invoice', 'notice', 'proposal', 'task', 'creditNote', 'client', 'employee', 'project', 'estimate', 'lead'])->nullable();
            $table->string('title');
            $table->string('route_name');
            $table->timestamps();

            $table->foreign('company_id', 'universal_search_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universal_search');
    }
}
