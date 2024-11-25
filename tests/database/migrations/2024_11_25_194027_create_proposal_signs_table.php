<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_signs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('proposal_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('signature')->nullable();
            $table->timestamps();

            $table->foreign('proposal_id', 'proposal_signs_proposal_id_foreign')->references('id')->on('proposals')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_signs');
    }
}
