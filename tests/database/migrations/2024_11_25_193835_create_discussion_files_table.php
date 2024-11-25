<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('discussion_id')->nullable();
            $table->unsignedInteger('discussion_reply_id')->nullable();
            $table->string('filename');
            $table->text('description')->nullable();
            $table->string('google_url')->nullable();
            $table->string('hashname')->nullable();
            $table->string('size')->nullable();
            $table->string('dropbox_link')->nullable();
            $table->string('external_link_name')->nullable();
            $table->timestamps();

            $table->foreign('company_id', 'discussion_files_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('discussion_id', 'discussion_files_discussion_id_foreign')->references('id')->on('discussions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('discussion_reply_id', 'discussion_files_discussion_reply_id_foreign')->references('id')->on('discussion_replies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'discussion_files_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion_files');
    }
}
