<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            OwnerSeeder::class,
            LocationSeeder::class,
            CruiseTypeSeeder::class,
            CruiseSeeder::class,
            CruiseImageSeeder::class,
            PackageSeeder::class,
            PackageImageSeeder::class,
            ItinerarySeeder::class,
            AmenitySeeder::class,
            FoodSeeder::class,
            PackageAmenitySeeder::class,
            PackageFoodSeeder::class,
            BookingTypeSeeder::class,
            PackageBookingTypeSeeder::class,
            PriceRuleSeeder::class,
            BookingSeeder::class,
            RatingSeeder::class,
            FavoriteSeeder::class,
            PaymentSeeder::class
        ]);
    }
}
