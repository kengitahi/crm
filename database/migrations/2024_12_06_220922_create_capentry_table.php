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
        Schema::create('project_finances_capentry', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('locks_and_fittings', 16, 2)->nullable();
            $table->decimal('closet_bathroom_stairs', 16, 2)->nullable();
            $table->decimal('capentry_suppliers', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_capentry');
    }
};
