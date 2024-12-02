<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proposal_number')->nullable();
            $table->string('original_proposal_number')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->date('valid_till');
            $table->double('sub_total', 30, 2);
            $table->double('total', 30, 2);
            $table->unsignedInteger('currency_id')->nullable();
            $table->enum('discount_type', ['percent', 'fixed']);
            $table->double('discount');
            $table->boolean('invoice_convert')->default(0);
            $table->enum('status', ['declined', 'accepted', 'waiting'])->default('waiting');
            $table->mediumText('note')->nullable();
            $table->longText('description')->nullable();
            $table->text('client_comment')->nullable();
            $table->boolean('signature_approval')->default(1);
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->text('hash')->nullable();
            $table->enum('calculate_tax', ['after_discount', 'before_discount'])->default('after_discount');
            $table->timestamps();
            $table->timestamp('last_viewed')->nullable();
            $table->string('ip_address')->nullable();
            $table->boolean('send_status')->default(1);

            $table->foreign('added_by', 'proposals_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'proposals_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'proposals_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deal_id', 'proposals_deal_id_foreign')->references('id')->on('deals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'proposals_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
