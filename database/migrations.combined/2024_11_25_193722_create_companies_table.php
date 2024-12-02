<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('app_name')->nullable();
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('logo')->nullable();
            $table->string('login_background')->nullable();
            $table->text('address');
            $table->string('website')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('timezone')->default('Asia/Kolkata');
            $table->string('date_format', 20)->default('d-m-Y');
            $table->string('date_picker_format')->default('dd-mm-yyyy');
            $table->string('year_starts_from')->default('1');
            $table->string('moment_format')->default('DD-MM-YYYY');
            $table->string('time_format', 20)->default('h:i a');
            $table->string('locale')->default('en');
            $table->decimal('latitude', 10, 8)->default(26.91243360);
            $table->decimal('longitude', 11, 8)->default(75.78727090);
            $table->enum('leaves_start_from', ['joining_date', 'year_start'])->default('joining_date');
            $table->enum('active_theme', ['default', 'custom'])->default('default');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedInteger('last_updated_by')->nullable();
            $table->string('google_map_key')->nullable();
            $table->enum('task_self', ['yes', 'no'])->default('yes');
            $table->boolean('rounded_theme')->default(1);
            $table->string('logo_background_color')->default('#ffffff');
            $table->string('header_color')->default('#1D82F5');
            $table->integer('before_days');
            $table->integer('after_days');
            $table->enum('on_deadline', ['yes', 'no'])->default('yes');
            $table->unsignedInteger('default_task_status')->nullable();
            $table->boolean('dashboard_clock')->default(1);
            $table->boolean('ticket_form_google_captcha')->default(0);
            $table->boolean('lead_form_google_captcha')->default(0);
            $table->integer('taskboard_length')->default(10);
            $table->integer('datatable_row_limit')->default(10);
            $table->string('favicon')->nullable();
            $table->enum('auth_theme', ['dark', 'light'])->default('light');
            $table->enum('auth_theme_text', ['dark', 'light'])->default('dark');
            $table->string('light_logo')->nullable();
            $table->enum('sidebar_logo_style', ['square', 'full'])->default('square');
            $table->tinyInteger('allow_client_signup');
            $table->tinyInteger('admin_client_signup_approval');
            $table->enum('google_calendar_status', ['active', 'inactive'])->default('inactive');
            $table->text('google_client_id')->nullable();
            $table->text('google_client_secret')->nullable();
            $table->enum('google_calendar_verification_status', ['verified', 'non_verified'])->default('non_verified');
            $table->string('google_id')->nullable();
            $table->string('name')->nullable();
            $table->text('token')->nullable();
            $table->string('hash')->nullable();
            $table->timestamps();
            $table->dateTime('last_login')->nullable();
            $table->boolean('rtl')->default(0);
            $table->boolean('show_new_webhook_alert')->default(0);
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four')->nullable();
            $table->boolean('employee_can_export_data')->default(1);
            $table->text('headers')->nullable();
            $table->string('register_ip')->nullable();
            $table->text('location_details')->nullable();

            $table->foreign('currency_id', 'companies_currency_id_foreign')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('default_task_status', 'companies_default_task_status_foreign')->references('id')->on('taskboard_columns')->onUpdate('cascade');
            $table->foreign('last_updated_by', 'companies_last_updated_by_foreign')->references('id')->on('users')->onDelete('set NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
