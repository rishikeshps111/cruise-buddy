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
        $cruiseModel = ['normal', 'full_upper_duck', 'semi_upper_duck'];
        $cruiseType = ['open', 'closed'];
        foreach ($cruiseModel as $model) {
            foreach ($cruiseType as $type) {

                CruiseType::updateOrCreate(
                    [
                        'model_name' => $model,
                        'type' => $type
                    ],
                    []
                );
            }
        }
    }
}
