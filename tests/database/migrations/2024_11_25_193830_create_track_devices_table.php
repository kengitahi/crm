<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_uuid')->unique('track_devices_device_uuid_unique');
            $table->string('device_type')->index('track_devices_device_type_index');
            $table->string('ip', 40)->index('track_devices_ip_index');
            $table->timestamp('device_hijacked_at')->nullable();
            $table->longText('data')->nullable();
            $table->boolean('is_rogue_device')->default(0)->index('track_devices_is_rogue_device_index');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_devices');
    }
}
