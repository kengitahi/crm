<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');
            $table->unsignedBigInteger('permission_type_id')->default(5);

            $table->primary(['permission_id', 'role_id']);
            $table->foreign('permission_id', 'permission_role_permission_id_foreign')->references('id')->on('permissions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('permission_type_id', 'permission_role_permission_type_id_foreign')->references('id')->on('permission_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id', 'permission_role_role_id_foreign')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
