<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesEstimatesEstimateRequestIdForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->foreign('estimate_request_id', 'estimates_estimate_request_id_foreign')->references('id')->on('estimate_requests')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->dropForeign('estimates_estimate_request_id_foreign');
        });
    }
}
