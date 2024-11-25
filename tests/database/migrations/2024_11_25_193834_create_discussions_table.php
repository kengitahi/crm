<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('discussion_category_id')->default(1);
            $table->unsignedInteger('project_id')->nullable();
            $table->string('title');
            $table->string('color', 20)->default('#232629');
            $table->unsignedInteger('user_id');
            $table->boolean('pinned')->default(0);
            $table->boolean('closed')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('last_reply_at')->default('current_timestamp()');
            $table->unsignedInteger('best_answer_id')->nullable();
            $table->unsignedInteger('last_reply_by_id')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'discussions_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('best_answer_id', 'discussions_best_answer_id_foreign')->references('id')->on('discussion_replies')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'discussions_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('discussion_category_id', 'discussions_discussion_category_id_foreign')->references('id')->on('discussion_categories')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_reply_by_id', 'discussions_last_reply_by_id_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'discussions_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'discussions_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'discussions_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
