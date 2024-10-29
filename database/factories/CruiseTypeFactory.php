<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CruiseType>
 */
class CruiseTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_name' => fake()->randomElement(['normal', 'full_upper_duck', 'semi_upper_duck']),
            'type' => fake()->randomElement(['open', 'closed']),
        ];
    }
}
