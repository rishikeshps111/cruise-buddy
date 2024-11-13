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
            $table->string('currency');
            $table->string('status');
            $table->string('order_id');
            $table->string('payment_method');
            $table->string('bank');
            $table->string('email');
            $table->string('contact');
            $table->longText('notes');
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
