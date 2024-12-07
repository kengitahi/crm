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
        Schema::create('project_finances_plumbing', function (Blueprint $table) {
            $table->id();
            $table->decimal('labour', 16, 2)->nullable();
            $table->decimal('materials', 16, 2)->nullable();
            $table->decimal('hydropneumatic_system', 16, 2)->nullable();
            $table->decimal('automated_sprinkler', 16, 2)->nullable();
            $table->decimal('tank', 16, 2)->nullable();
            $table->decimal('basic_material', 16, 2)->nullable();
            $table->decimal('heater', 16, 2)->nullable();
            $table->decimal('bathroom', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plumbing');
    }
};
