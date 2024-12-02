<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');
            $table->unsignedBigInteger('permission_type_id');
            $table->timestamps();

            $table->unique(['permission_id', 'user_id'], 'user_permissions_permission_id_user_id_unique');
            $table->foreign('permission_id', 'user_permissions_permission_id_foreign')->references('id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('permission_type_id', 'user_permissions_permission_type_id_foreign')->references('id')->on('permission_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'user_permissions_user_id_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
}
