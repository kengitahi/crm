<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('discussion_id');
            $table->unsignedInteger('user_id');
            $table->longText('body');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('company_id', 'discussion_replies_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('discussion_id', 'discussion_replies_discussion_id_foreign')->references('id')->on('discussions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'discussion_replies_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion_replies');
    }
}
