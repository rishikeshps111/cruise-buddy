<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->first()->id,
            'payment_id' => fake()->unique()->userName(),
            'amount' => fake()->numberBetween(100, 10000),
            'currency' => 'IND',
            'status' => fake()->word(),
            'order_id' => fake()->unique()->userName(),
            'payment_method' => fake()->word(),
            'bank' => fake()->word(),
            'email' => fake()->email(),
            'contact' => fake()->phoneNumber(),
            'notes' => fake()->paragraph(),
            'is_active' => fake()->boolean()
        ];
    }
}
