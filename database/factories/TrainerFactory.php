<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trainer>
 */
class TrainerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'photo' => null,
            'specialty' => fake()->randomElement(['Strength Training', 'HIIT', 'Yoga', 'Nutrition', 'Bodybuilding']),
            'bio' => fake()->paragraph(3),
            'certifications' => [fake()->sentence(3), fake()->sentence(3)],
            'social_links' => [
                'instagram' => 'https://instagram.com/' . fake()->userName(),
                'twitter' => 'https://twitter.com/' . fake()->userName(),
            ],
        ];
    }
}
