<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->string('original_order_number')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->date('order_date');
            $table->double('sub_total', 30, 2);
            $table->double('discount')->default(0);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            $table->double('total', 30, 2);
            $table->enum('status', ['pending', 'on-hold', 'failed', 'processing', 'completed', 'canceled', 'refunded'])->default('pending');
            $table->unsignedInteger('currency_id')->nullable();
            $table->enum('show_shipping_address', ['yes', 'no'])->default('no');
            $table->string('note')->nullable();
            $table->unsignedInteger('added_by')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->unsignedBigInteger('company_address_id')->nullable();
            $table->string('custom_order_number')->nullable();
            $table->timestamps();

            $table->foreign('added_by', 'orders_added_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('client_id', 'orders_client_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_address_id', 'orders_company_address_id_foreign')->references('id')->on('company_addresses')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('company_id', 'orders_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('currency_id', 'orders_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'orders_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
            $table->foreign('project_id', 'orders_project_id_foreign')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
