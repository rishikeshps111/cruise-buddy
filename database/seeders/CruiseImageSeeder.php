<?php

namespace Database\Seeders;


use App\Models\CruisesImage;
use Illuminate\Database\Seeder;

class CruiseImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CruisesImage::factory(500)->create();
    }
}
