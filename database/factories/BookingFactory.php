<?php

namespace Database\Factories;

use App\Models\BookingType;
use App\Models\Package;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => IdGenerator::generate([
                'table' => 'bookings',
                'field' => 'order_id',
                'length' => 10,
                'prefix' => 'INV-'
            ]),
            'user_id' => User::doesntHave('owners')->inRandomOrder()->first()->id,
            'package_id' => Package::inRandomOrder()->first()->id,
            'booking_type_id' => BookingType::inRandomOrder()->first()->id,
            'total_amount' => fake()->numberBetween(100, 1000),
            'amount_paid' => fake()->numberBetween(100, 1000),
            'balance_amount' => fake()->numberBetween(100, 1000),
            'customer_note' => fake()->paragraph(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'fulfillment_status' => fake()->randomElement(['pending', 'partially_paid', 'paid', 'payment_failed', 'cancelled', 'other']),
            'is_active' => fake()->boolean()
        ];
    }
}