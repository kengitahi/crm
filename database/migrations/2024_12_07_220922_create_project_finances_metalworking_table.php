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
        Schema::create('project_finances_metalworking', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('suppliers', 16, 2)->nullable();
            $table->decimal('materials', 16, 2)->nullable();
            $table->decimal('labour', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metalworking');
    }
};
