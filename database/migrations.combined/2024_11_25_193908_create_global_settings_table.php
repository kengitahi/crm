<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            $table->string('global_app_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('light_logo')->nullable();
            $table->string('login_background')->nullable();
            $table->string('logo_background_color')->nullable();
            $table->string('header_color')->default('#1D82F5');
            $table->string('sidebar_logo_style')->default('square');
            $table->string('locale')->default('en');
            $table->string('hash')->nullable();
            $table->string('purchase_code', 100)->nullable();
            $table->timestamp('supported_until')->nullable();
            $table->timestamp('purchased_on')->nullable();
            $table->timestamp('last_license_verified_at')->nullable();
            $table->enum('google_recaptcha_status', ['active', 'deactive'])->default('deactive');
            $table->enum('google_recaptcha_v2_status', ['active', 'deactive'])->default('deactive');
            $table->string('google_recaptcha_v2_site_key')->nullable();
            $table->string('google_recaptcha_v2_secret_key')->nullable();
            $table->enum('google_recaptcha_v3_status', ['active', 'deactive'])->default('deactive');
            $table->string('google_recaptcha_v3_site_key')->nullable();
            $table->string('google_recaptcha_v3_secret_key')->nullable();
            $table->boolean('app_debug')->default(0);
            $table->string('currency_converter_key');
            $table->string('currency_key_version')->default('free');
            $table->string('dedicated_subdomain')->nullable();
            $table->string('date_format', 20)->default('d-m-Y');
            $table->string('time_format', 20)->default('h:i a');
            $table->string('moment_format')->default('DD-MM-YYYY');
            $table->string('timezone')->default('Asia/Kolkata');
            $table->boolean('rtl')->default(0);
            $table->string('license_type', 20)->nullable();
            $table->boolean('hide_cron_message')->default(0);
            $table->boolean('system_update')->default(1);
            $table->boolean('show_review_modal')->default(1);
            $table->timestamp('last_cron_run')->nullable();
            $table->string('favicon')->nullable();
            $table->enum('auth_theme', ['dark', 'light'])->default('light');
            $table->enum('auth_theme_text', ['dark', 'light'])->default('dark');
            $table->enum('session_driver', ['file', 'database'])->default('file');
            $table->text('allowed_file_types')->nullable();
            $table->integer('allowed_file_size')->default(10);
            $table->integer('allow_max_no_of_files')->default(10);
            $table->integer('datatable_row_limit')->default(10);
            $table->boolean('show_update_popup')->default(1);
            $table->text('terms_link')->nullable();
            $table->enum('sign_up_terms', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->text('google_map_key')->nullable();
            $table->enum('google_calendar_status', ['active', 'inactive'])->default('inactive');
            $table->text('google_client_id')->nullable();
            $table->text('google_client_secret')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_settings');
    }
}
