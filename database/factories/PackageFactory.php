<?php

namespace Database\Factories;

use App\Models\Cruise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cruise_id' => Cruise::inRandomOrder()->first()->id,
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'slug' => fake()->slug(),
            'is_active' => fake()->boolean()
        ];
    }
}
