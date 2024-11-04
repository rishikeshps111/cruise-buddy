<?php

namespace Database\Seeders;

use App\Models\Cruise;
use Illuminate\Database\Seeder;

class CruiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cruise::factory(50)->create();
    }
}
