<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\Location;
use App\Models\CruiseType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cruise>
 */
class CruiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => Owner::factory(),             
            'cruise_type_id' => CruiseType::factory(),  
            'location_id' => Location::factory(),       
            'rooms' => fake()->numberBetween(4, 10),
            'max_capacity' => fake()->numberBetween(20, 60),
            'description' => fake()->paragraph(),
            'is_active' => fake()->boolean(),
        ];
    }
}