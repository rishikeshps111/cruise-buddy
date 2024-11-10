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
        Schema::create('package_foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('package_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('food_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('dining_time', ['breakfast', 'lunch', 'snacks', 'dinner', 'all'])
                ->default('all');

            $table->unique(['package_id', 'food_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_foods');
    }
};
