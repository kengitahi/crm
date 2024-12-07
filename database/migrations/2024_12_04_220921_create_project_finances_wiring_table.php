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
        Schema::create('project_finances_wiring', function (Blueprint $table) {
            $table->id();
            $table->decimal('labour', 16, 2)->nullable();
            $table
                ->decimal('lighting_fixtures_and_accessories', 16, 2)
                ->nullable();
            $table->decimal('intercommunication', 16, 2)->nullable();
            $table->decimal('various_materials', 16, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wiring');
    }
};
