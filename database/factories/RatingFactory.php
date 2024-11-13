<?php

namespace Database\Factories;

use App\Models\Cruise;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::doesntHave('owners')->inRandomOrder()->first()->id,
            'cruise_id' => Cruise::inRandomOrder()->first()->id,
            'rating' => fake()->numberBetween(1, 5),
            'description' => fake()->paragraph()
        ];
    }
}
