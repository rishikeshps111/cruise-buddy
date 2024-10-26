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
        Schema::create('cruises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('owner_id');
            $table->foreign('owner_id')
                ->references('id')->on('owners')
                ->onDelete('cascade');
            $table->bigIncrements('type_id');
            $table->foreign('type_id')
                ->references('id')->on('cruise_types')
                ->onDelete('cascade');
            $table->bigIncrements('location_id');
            $table->foreign('location_id')
                ->references('id')->on('location')
                ->onDelete('cascade');
            $table->integer('rooms');
            $table->integer('max_capacity');
            $table->longText('description');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cruises');
    }
};
