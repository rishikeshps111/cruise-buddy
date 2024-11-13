<?php

namespace Database\Seeders;

use App\Models\Cruise;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Favorite::factory(100)->create();
        for ($i = 0; $i < 50; $i++) {
            Favorite::updateOrCreate(
                [
                    'user_id' => User::inRandomOrder()->first()->id,
                    'cruise_id' => Cruise::inRandomOrder()->first()->id
                ],
                []
            );
        }
    }
}
