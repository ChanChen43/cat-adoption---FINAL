<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456789'),
                // is_admin flag to true
                'is_admin' => true,
            ]
        );

        //user account use the similar code above but only for a normal user not admin
        User::updateOrCreate(
            ['email' => 'test1@gmail.com'],
            [
                'name' => 'Test User 1',
                'password' => Hash::make('123456789'),
                'is_admin' => false,
            ]
        );

        //add more until test3 auto fill
        User::updateOrCreate(
            ['email' => 'test2@gmail.com'],
            [
                'name' => 'Test User 2',
                'password' => Hash::make('123456789'),
                'is_admin' => false,
            ]
        );
        //add more until test3 auto fill
        User::updateOrCreate(
            ['email' => 'test3@gmail.com'],
            [
                'name' => 'Test User 3',
                'password' => Hash::make('123456789'),
                'is_admin' => false,
            ]
        );

    }
}
