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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('payment_id');
            $table->decimal('amount');
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->string('order_id');
            $table->string('payment_method')->nullable();
            $table->string('bank')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('is_webhook')->default(true);
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
        Schema::dropIfExists('payments');
    }
};
