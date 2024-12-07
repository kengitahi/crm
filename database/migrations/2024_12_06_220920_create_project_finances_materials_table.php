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
        Schema::create('project_finances_materials', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('rod_wire_armex', 16, 2)->nullable();
            $table->decimal('prefabricated_systems', 16, 2)->nullable();
            $table->decimal('cement_mortar', 16, 2)->nullable();
            $table->decimal('premixed_concrete', 16, 2)->nullable();
            $table->decimal('block_and_brick', 16, 2)->nullable();
            $table->decimal('basic_material', 16, 2)->nullable();
            $table->decimal('sand_and_material_freight', 16, 2)->nullable();
            $table->decimal('waterproofing', 16, 2)->nullable();
            $table->decimal('miscellaneous', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
