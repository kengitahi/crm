<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_finances_operation', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('administration', 16, 2)->nullable();
            $table->decimal('accounting', 16, 2)->nullable();
            $table->decimal('legal', 16, 2)->nullable();
            $table->decimal('sales_suppliers', 16, 2)->nullable();
            $table->decimal('advertising_suppliers', 16, 2)->nullable();
            $table->decimal('tax_redial', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation');
    }
};
