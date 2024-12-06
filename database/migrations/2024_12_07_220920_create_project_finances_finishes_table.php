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
        Schema::create('project_finances_finishes', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('wooden_stairs', 16, 2)->nullable();
            $table->decimal('marble_and_granites', 16, 2)->nullable();
            $table->decimal('wooden_stave', 16, 2)->nullable();
            $table->decimal('wall_covering', 16, 2)->nullable();
            $table->decimal('kitchens', 16, 2)->nullable();
            $table->decimal('carpentry', 16, 2)->nullable();
            $table->decimal('outdoor_areas', 16, 2)->nullable();
            $table->decimal('bathroom_furniture', 16, 2)->nullable();
            $table->decimal('marble_slabs', 16, 2)->nullable();
            $table->decimal('floors', 16, 2)->nullable();
            $table->decimal('finishes_labour', 16, 2)->nullable();
            $table->decimal('finishes_suppliers', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_finishes');
    }
};
