<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageImage>
 */
class PackageImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_id' => Package::inRandomOrder()->first()->id,
            'package_img' => 'default/dummy-avatar.jpg',
            'alt' => fake()->word(),
        ];
    }
}
