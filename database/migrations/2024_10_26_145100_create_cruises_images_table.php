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
        Schema::create('cruises_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cruise_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('cruise_img');
            $table->string('alt',50)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cruises_images');
    }
};
