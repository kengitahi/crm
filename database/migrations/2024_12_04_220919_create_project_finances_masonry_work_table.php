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
        Schema::create('project_finances_masonry_work', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('masonry_suppliers', 16, 2)->nullable();
            $table->decimal('masonry_labour', 16, 2)->nullable();
            $table->decimal('supervision', 16, 2)->nullable();
            $table->decimal('several', 16, 2)->nullable();
            $table->decimal('scaffolding', 16, 2)->nullable();
            $table->decimal('mixer_and_equipment', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masonry');
    }
};
