<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Program>
 */
class ProgramFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'description' => fake()->paragraph(),
            'icon' => null,
            'duration' => fake()->randomElement(['4 weeks', '8 weeks', '12 weeks']),
            'intensity' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'schedule' => fake()->randomElement(['3x/week', '4x/week', '5x/week', '6x/week']),
        ];
    }
}
