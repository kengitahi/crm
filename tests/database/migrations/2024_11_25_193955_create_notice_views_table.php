<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('notice_id');
            $table->unsignedInteger('user_id');
            $table->boolean('read')->default(0);
            $table->timestamps();

            $table->foreign('company_id', 'notice_views_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('notice_id', 'notice_views_notice_id_foreign')->references('id')->on('notices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'notice_views_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_views');
    }
}
