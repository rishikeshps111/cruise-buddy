<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageFoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();
        $food = Food::all();
        foreach ($packages as $key => $packages) {
            $randomFood = $food->random(rand(1, 5))->pluck('id')->toArray();
            $attachData = [];
            foreach ($randomFood as $item) {
                $attachData[$item] = [
                    'dining_time' => fake()->randomElement(['breakfast', 'lunch', 'snacks', 'dinner', 'all'])
                ];
            }
            $packages->food()->attach($attachData);
        }
    }
}
