<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PackageAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = Package::all();
        $amenities = Amenity::all();

        foreach ($packages as $key => $package) {
            $randomAmenities = $amenities->random(rand(1, 5))->pluck('id')->toArray();
            try {
                $package->amenity()->attach($randomAmenities);
            } catch (QueryException $th) {
                Log::info('Package amenity seeder :' . $th->getMessage());
            }
        }
    }
}
