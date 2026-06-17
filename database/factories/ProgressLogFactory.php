<?php

namespace Database\Factories;

use App\Models\ProgressLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProgressLog>
 */
class ProgressLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'weight' => fake()->randomFloat(1, 60, 120),
            'body_fat' => fake()->optional()->randomFloat(1, 8, 35),
        ];
    }
}
