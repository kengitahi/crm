<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appreciations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('award_id');
            $table->unsignedInteger('award_to');
            $table->date('award_date');
            $table->string('image')->nullable();
            $table->text('summary')->nullable();
            $table->unsignedInteger('added_by');
            $table->timestamps();

            $table->foreign('added_by', 'appreciations_added_by_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('award_id', 'appreciations_award_id_foreign')->references('id')->on('awards')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('award_to', 'appreciations_award_to_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'appreciations_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appreciations');
    }
}
