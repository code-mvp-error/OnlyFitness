<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'goal' => fake()->randomElement(['lose_weight', 'build_muscle', 'general_fitness']),
            'plan' => fake()->randomElement(['basic', 'pro', 'elite']),
            'message' => fake()->paragraph(2),
            'status' => 'unread',
        ];
    }
}
