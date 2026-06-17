<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plan>
 */
class PlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'price_monthly' => fake()->randomFloat(2, 10, 100),
            'price_yearly' => fake()->randomFloat(2, 100, 1000),
            'features' => [fake()->sentence(3), fake()->sentence(3), fake()->sentence(3)],
            'is_popular' => false,
        ];
    }
}
