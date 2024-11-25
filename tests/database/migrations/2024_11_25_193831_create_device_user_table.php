<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('device_user_user_id_index');
            $table->unsignedBigInteger('device_id');
            $table->string('name')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('reported_as_rogue_at')->nullable()->index('device_user_reported_as_rogue_at_index');
            $table->text('note')->nullable();
            $table->text('admin_note')->nullable();
            $table->longText('data')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'device_id'], 'device_user_user_id_device_id_index');
            $table->foreign('device_id', 'device_user_device_id_foreign')->references('id')->on('track_devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_user');
    }
}
