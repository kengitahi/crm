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
        Schema::create('project_finances_additional_costs', function (
            Blueprint $table
        ) {
            $table->id();
            $table->decimal('imss', 16, 2)->nullable();
            $table->decimal('infornavit', 16, 2)->nullable();
            $table->decimal('accounting', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_osts');
    }
};
