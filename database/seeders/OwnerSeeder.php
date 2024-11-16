<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Owner::factory(10)->create();
        // set permission for user and owners
        $owners = User::has('owner')->get();
        $users = User::doesntHave('owner')->get();
        foreach ($owners as $owner) {
            $owner->assignRole('owner');
        }
        foreach ($users as $user) {
            if (!$user->hasRole('admin'))
                $user->assignRole('user');
        }
    }
}
