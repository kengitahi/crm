<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('award_icon_id')->nullable();
            $table->text('summary')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('color_code');
            $table->timestamps();

            $table->foreign('award_icon_id', 'awards_award_icon_id_foreign')->references('id')->on('award_icons')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id', 'awards_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('awards');
    }
}
