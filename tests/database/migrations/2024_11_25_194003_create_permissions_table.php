<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('module_id');
            $table->boolean('is_custom')->default(0);
            $table->text('allowed_permissions')->nullable();
            $table->timestamps();

            $table->unique(['name', 'module_id'], 'permissions_name_module_id_unique');
            $table->foreign('module_id', 'permissions_module_id_foreign')->references('id')->on('modules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
