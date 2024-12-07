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
        Schema::create('project_finances_gardening', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('plants_and_pots', 16, 2)->nullable();
            $table->decimal('suppliers', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gardening');
    }
};
