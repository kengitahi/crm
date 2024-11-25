<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('filename', 200);
            $table->string('hashname', 200);
            $table->string('size', 200);
            $table->text('description')->nullable();
            $table->string('google_url')->nullable();
            $table->string('dropbox_link')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('deal_id', 'deal_files_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('added_by', 'lead_files_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'lead_files_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('user_id', 'lead_files_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_files');
    }
}
