<?php

namespace Database\Seeders;

use App\Models\BookingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookingTypes = ['day_cruise', 'full_day_cruise', 'custom_range'];
        foreach ($bookingTypes as $type) {
            BookingType::updateOrCreate(
                [
                    'name' => $type,
                    'icon' => 'default/dummy-avatar.jpg'
                ],
                []
            );
        }
    }
}
