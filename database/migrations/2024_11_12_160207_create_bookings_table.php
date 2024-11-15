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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('booking_type_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('minimum_amount_paid', 8, 2)->nullable();
            $table->decimal('amount_paid', 8, 2)->nullable();
            $table->decimal('balance_amount', 8, 2)->nullable();
            $table->longText('customer_note')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum(
                'fulfillment_status',
                [
                    'pending',
                    'partially_paid',
                    'paid',
                    'payment_failed',
                    'cancelled',
                    'blocked_by_owner',
                    'other'
                ]
            )->default('pending');
            $table->boolean('booked_by_user')->default(true);
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
        Schema::dropIfExists('bookings');
    }
};
