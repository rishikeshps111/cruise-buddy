<?php

namespace Database\Seeders;

use App\Models\CruiseType;
use Illuminate\Database\Seeder;

class CruiseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CruiseType::factory(5)->create();
    }
}
