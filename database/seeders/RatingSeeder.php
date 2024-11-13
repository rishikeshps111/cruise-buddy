<?php

namespace Database\Seeders;

use App\Models\Cruise;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rating::factory(50)->create(); duplicate error
        for ($i = 0; $i < 50; $i++) {

            Rating::updateOrCreate(
                [
                    'user_id' => User::doesntHave('owners')->inRandomOrder()->first()->id,
                    'cruise_id' => Cruise::inRandomOrder()->first()->id
                ],
                [
                    'rating' => fake()->numberBetween(1, 5),
                    'description' => fake()->paragraph()
                ]
            );
        }
    }
}
