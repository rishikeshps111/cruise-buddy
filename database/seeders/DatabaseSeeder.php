<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      

        $this->call([
            // PermissionSeeder::class,
            // UserSeeder::class,
            // OwnerSeeder::class,
            // LocationSeeder::class,
            // CruiseSeeder::class,
            // CruiseTypeSeeder::class,
            CruiseImageSeeder::class,
            
        ]);
    }
}
