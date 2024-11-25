<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->boolean('two_factor_confirmed')->default(0);
            $table->boolean('two_factor_email_confirmed')->default(0);
            $table->string('image')->nullable();
            $table->integer('country_phonecode')->nullable();
            $table->string('mobile')->nullable();
            $table->enum('gender', ['male', 'female', 'others'])->default('male');
            $table->enum('salutation', ['mr', 'mrs', 'miss', 'dr', 'sir', 'madam'])->nullable();
            $table->string('locale')->default('en');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->enum('login', ['enable', 'disable'])->default('enable');
            $table->text('onesignal_player_id')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('email_notifications')->default(1);
            $table->unsignedInteger('country_id')->nullable();
            $table->tinyInteger('dark_theme');
            $table->tinyInteger('rtl');
            $table->enum('two_fa_verify_via', ['email', 'google_authenticator', 'both'])->nullable();
            $table->string('two_factor_code')->nullable()->comment('when authenticator is email');
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->boolean('admin_approval')->default(1);
            $table->boolean('permission_sync')->default(1);
            $table->boolean('google_calendar_status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('customised_permissions')->default(0);
            $table->string('stripe_id')->nullable()->index('users_stripe_id_index');
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->text('headers')->nullable();
            $table->string('register_ip')->nullable();
            $table->text('location_details')->nullable();
            $table->date('inactive_date')->nullable();
            $table->string('twitter_id')->nullable();

            $table->unique(['email', 'company_id'], 'users_email_company_id_unique');
            $table->foreign('company_id', 'users_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id', 'users_country_id_foreign')->references('id')->on('countries')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
