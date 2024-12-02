<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalTemplateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_template_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('proposal_template_id');
            $table->string('hsn_sac_code')->nullable();
            $table->string('item_name');
            $table->enum('type', ['item', 'discount', 'tax'])->default('item');
            $table->double('quantity');
            $table->double('unit_price');
            $table->double('amount');
            $table->text('item_summary')->nullable();
            $table->string('taxes')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();

            $table->foreign('company_id', 'proposal_template_items_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id', 'proposal_template_items_product_id_foreign')->references('id')->on('products')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('proposal_template_id', 'proposal_template_items_proposal_template_id_foreign')->references('id')->on('proposal_templates')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id', 'proposal_template_items_unit_id_foreign')->references('id')->on('unit_types')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_template_items');
    }
}
