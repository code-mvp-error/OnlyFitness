<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@onlyfitness.com',
            'phone' => '555-0000',
            'goal' => 'General Fitness',
        ]);

        User::factory()->create([
            'name' => 'Alex Johnson',
            'email' => 'alex@example.com',
            'phone' => '555-1001',
            'goal' => 'Weight Loss',
        ]);

        User::factory()->create([
            'name' => 'Jamie Williams',
            'email' => 'jamie@example.com',
            'phone' => '555-1002',
            'goal' => 'Muscle Building',
        ]);

        User::factory()->create([
            'name' => 'Taylor Brooks',
            'email' => 'taylor@example.com',
            'phone' => '555-1003',
            'goal' => 'General Fitness',
        ]);

        User::factory()->create([
            'name' => 'Morgan Reed',
            'email' => 'morgan@example.com',
            'phone' => '555-1004',
            'goal' => 'Endurance',
        ]);

        $this->call([
            ProgramSeeder::class,
            TrainerSeeder::class,
            PlanSeeder::class,
        ]);

        $this->call([
            BookingSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
