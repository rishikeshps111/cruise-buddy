<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            $package->amenity()->attach($randomAmenities);
        }
    }
}
