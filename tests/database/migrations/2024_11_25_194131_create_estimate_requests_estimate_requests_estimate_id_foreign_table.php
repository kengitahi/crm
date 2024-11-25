<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateRequestsEstimateRequestsEstimateIdForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estimate_requests', function (Blueprint $table) {
            $table->foreign('estimate_id', 'estimate_requests_estimate_id_foreign')->references('id')->on('estimates')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estimate_requests', function (Blueprint $table) {
            $table->dropForeign('estimate_requests_estimate_id_foreign');
        });
    }
}
