<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('test@example.com'),
                'phone' => '+919999988888',
                'country_code' => 'in',
                'email_verified_at' => now()
            ]
        );

        $user->assignRole('admin');
    }
}
