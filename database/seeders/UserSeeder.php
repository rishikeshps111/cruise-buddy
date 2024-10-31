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
        $user =  User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test@example.com'),
            'phone' => '8047892340',
            'country_code' => '+91',
            'email_verified_at' => now()
        ]);

        $user->assignRole('admin');

        User::factory(10)->create();
    }
}
