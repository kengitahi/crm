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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->decimal('who', 16, 2)->nullable();
            $table->decimal('cfe', 16, 2)->nullable();
            $table->decimal('condominiumRegime', 16, 2)->nullable();
            $table->decimal('licenseAndAlignment', 16, 2)->nullable();
            $table->decimal('rooms', 16, 2)->nullable();
            $table->decimal('mobility', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
