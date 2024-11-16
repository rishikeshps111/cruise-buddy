<?php

namespace Database\Factories;

use App\Models\BookingType;
use App\Models\PackageBookingType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriceRule>
 */
class PriceRuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $days = rand(1, 90);
        return [
            'package_booking_type_id' => PackageBookingType::inRandomOrder()->first()->id,
            'price_type' => fake()->randomElement(['date', 'weekends', 'custom_range']),
            'price' => fake()->numberBetween(100, 1000),
            'compare_price' => fake()->numberBetween(100, 1000),
            'min_amount_to_pay' => fake()->numberBetween(100, 1000),
            'price_per_person' => fake()->numberBetween(100, 1000),
            'price_per_bed' => fake()->numberBetween(100, 1000),
            'start_date' => Carbon::now()->addDays($days),
            'end_date' => Carbon::now()->addDays($days + rand(1, 5)),
        ];
    }
}
