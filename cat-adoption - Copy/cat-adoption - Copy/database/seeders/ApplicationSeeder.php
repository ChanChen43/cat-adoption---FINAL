<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Cat;
use App\Models\User;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users and cats
        $users = User::where('is_admin', false)->get();
        $cats = Cat::all();

        // Seed applications
        foreach ($users as $user) {
            foreach ($cats->random(3) as $cat) { // Each user applies for 3 random cats
                Application::create([
                    'user_id' => $user->id,
                    'cat_id' => $cat->id,
                    'fee' => rand(50, 200),
                    'salary' => rand(15000, 50000),
                    'status' => ['pending', 'approved', 'declined'][array_rand(['pending', 'approved', 'declined'])],
                    'payment_status' => rand(0, 1),
                ]);
            }
        }
    }
}
