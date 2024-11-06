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
        Schema::create('package_amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('package_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('amenity_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_amenities');
    }
};
