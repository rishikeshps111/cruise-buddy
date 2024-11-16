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
        Schema::create('price_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('package_booking_type_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('price_type', ['date', 'weekends', 'custom_range']);
            $table->decimal('price', 8, 2);
            $table->decimal('price_per_day', 8, 2)->nullable();
            $table->decimal('compare_price', 8, 2)->nullable();
            $table->decimal('min_amount_to_pay', 8, 2);
            $table->decimal('price_per_person', 8, 2);
            $table->decimal('price_per_bed', 8, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('price_rules');
    }
};
