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
        Schema::create('package_booking_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('package_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('booking_type_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('price', 8, 2);
            $table->decimal('compare_price', 8, 2);
            $table->decimal('min_amount_to_pay', 8, 2);
            $table->decimal('price_per_person', 8, 2);
            $table->decimal('price_per_bed', 8, 2);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['package_id', 'booking_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_booking_types');
    }
};
