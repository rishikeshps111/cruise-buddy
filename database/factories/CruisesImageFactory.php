<?php

namespace Database\Factories;

use App\Models\Cruise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CruisesImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cruise_id' => Cruise::factory(),
            'cruise_img' => fake()->imageUrl(640, 480, 'cruise'),
            'alt' =>fake()->sentence(),
        ];
    }
}
