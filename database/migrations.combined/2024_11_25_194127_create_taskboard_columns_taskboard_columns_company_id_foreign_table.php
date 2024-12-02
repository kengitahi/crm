<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskboardColumnsTaskboardColumnsCompanyIdForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taskboard_columns', function (Blueprint $table) {
            $table->foreign('company_id', 'taskboard_columns_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taskboard_columns', function (Blueprint $table) {
            $table->dropForeign('taskboard_columns_company_id_foreign');
        });
    }
}
