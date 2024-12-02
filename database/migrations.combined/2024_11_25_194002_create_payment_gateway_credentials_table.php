<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewayCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway_credentials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('paypal_client_id')->nullable();
            $table->string('paypal_secret')->nullable();
            $table->enum('paypal_status', ['active', 'deactive'])->default('deactive');
            $table->string('live_stripe_client_id')->nullable();
            $table->text('live_stripe_secret')->nullable();
            $table->string('live_stripe_webhook_secret')->nullable();
            $table->enum('stripe_status', ['active', 'deactive'])->default('deactive');
            $table->string('live_razorpay_key')->nullable();
            $table->text('live_razorpay_secret')->nullable();
            $table->string('live_razorpay_webhook_secret')->nullable();
            $table->enum('razorpay_status', ['active', 'inactive'])->default('inactive');
            $table->enum('paypal_mode', ['sandbox', 'live'])->default('sandbox');
            $table->string('sandbox_paypal_client_id')->nullable();
            $table->text('sandbox_paypal_secret')->nullable();
            $table->string('test_stripe_client_id')->nullable();
            $table->text('test_stripe_secret')->nullable();
            $table->string('test_razorpay_key')->nullable();
            $table->text('test_razorpay_secret')->nullable();
            $table->string('test_razorpay_webhook_secret')->nullable();
            $table->text('test_stripe_webhook_secret')->nullable();
            $table->enum('stripe_mode', ['test', 'live'])->default('test');
            $table->enum('razorpay_mode', ['test', 'live'])->default('test');
            $table->string('paystack_key')->nullable();
            $table->text('paystack_secret')->nullable();
            $table->string('paystack_merchant_email')->nullable();
            $table->enum('paystack_status', ['active', 'deactive'])->default('deactive');
            $table->enum('paystack_mode', ['sandbox', 'live'])->default('sandbox');
            $table->string('test_paystack_key')->nullable();
            $table->text('test_paystack_secret')->nullable();
            $table->string('test_paystack_merchant_email')->nullable();
            $table->string('paystack_payment_url')->default('https://api.paystack.co');
            $table->text('mollie_api_key')->nullable();
            $table->enum('mollie_status', ['active', 'deactive'])->default('deactive');
            $table->string('payfast_merchant_id')->nullable();
            $table->text('payfast_merchant_key')->nullable();
            $table->string('payfast_passphrase')->nullable();
            $table->enum('payfast_mode', ['sandbox', 'live'])->default('sandbox');
            $table->enum('payfast_status', ['active', 'deactive'])->default('deactive');
            $table->string('authorize_api_login_id')->nullable();
            $table->text('authorize_transaction_key')->nullable();
            $table->enum('authorize_environment', ['sandbox', 'live'])->default('sandbox');
            $table->enum('authorize_status', ['active', 'deactive'])->default('deactive');
            $table->string('square_application_id')->nullable();
            $table->text('square_access_token')->nullable();
            $table->string('square_location_id')->nullable();
            $table->enum('square_environment', ['sandbox', 'production'])->default('sandbox');
            $table->enum('square_status', ['active', 'deactive'])->default('deactive');
            $table->enum('flutterwave_status', ['active', 'deactive'])->default('deactive');
            $table->enum('flutterwave_mode', ['sandbox', 'live'])->default('sandbox');
            $table->string('test_flutterwave_key')->nullable();
            $table->text('test_flutterwave_secret')->nullable();
            $table->string('test_flutterwave_hash')->nullable();
            $table->text('live_flutterwave_key')->nullable();
            $table->string('live_flutterwave_secret')->nullable();
            $table->string('live_flutterwave_hash')->nullable();
            $table->string('flutterwave_webhook_secret_hash')->nullable();
            $table->timestamps();
            $table->string('test_payfast_merchant_id')->nullable();
            $table->text('test_payfast_merchant_key')->nullable();
            $table->string('test_payfast_passphrase')->nullable();

            $table->foreign('company_id', 'payment_gateway_credentials_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_gateway_credentials');
    }
}
