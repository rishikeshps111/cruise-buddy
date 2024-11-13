<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\BookingType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackageBookingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();
        $bookingTypes = BookingType::pluck('id')->toArray();
        foreach ($packages as $package) {
            $pivotData = [];
            foreach ($bookingTypes as $bookingTypeId) {
                $pivotData[$bookingTypeId] = [
                    'price' => fake()->numberBetween(100, 1000),
                    'compare_price' => fake()->numberBetween(100, 1000),
                    'min_amount_to_pay' => fake()->numberBetween(100, 1000),
                    'price_per_person' => fake()->numberBetween(100, 1000),
                    'price_per_bed' => fake()->numberBetween(100, 1000)
                ];
            }
            try {   
                $package->bookingTypes()->attach($pivotData);
            } catch (QueryException $th) {
                Log::info('Package amenity seeder :' . $th->getMessage());
            }
        }
    }
}
