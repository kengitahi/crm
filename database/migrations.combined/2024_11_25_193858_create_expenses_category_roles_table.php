<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesCategoryRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_category_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedBigInteger('expenses_category_id')->nullable();
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->foreign('company_id', 'expenses_category_roles_company_id_foreign')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expenses_category_id', 'expenses_category_roles_expenses_category_id_foreign')->references('id')->on('expenses_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id', 'expenses_category_roles_role_id_foreign')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_category_roles');
    }
}
