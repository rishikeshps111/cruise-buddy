<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('proof_type', ['aadhaar', 'passport', 'voter_id', 'driving_license'])->nullable();
            $table->string('proof_id', 50)->nullable();
            $table->string('proof_image')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('additional_phone', 50)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE owners AUTO_INCREMENT = 1000;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
