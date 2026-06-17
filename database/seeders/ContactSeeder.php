<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            ['name' => 'John Smith', 'email' => 'john.smith@email.com', 'phone' => '555-0101', 'goal' => 'lose_weight', 'plan' => 'basic', 'message' => 'I am interested in learning more about your weight loss programs. Can you send me information about pricing and availability?'],
            ['name' => 'Lisa Brown', 'email' => 'lisa.brown@email.com', 'phone' => '555-0102', 'goal' => 'build_muscle', 'plan' => 'pro', 'message' => 'I want to build muscle mass and get stronger. Do you offer personalized training plans for beginners?'],
            ['name' => 'Mike Wilson', 'email' => 'mike.wilson@email.com', 'phone' => '555-0103', 'goal' => 'general_fitness', 'plan' => 'basic', 'message' => 'Looking to improve my overall fitness level. What programs do you recommend for someone who has been inactive for a while?'],
            ['name' => 'Anna Garcia', 'email' => 'anna.garcia@email.com', 'phone' => '555-0104', 'goal' => 'general_fitness', 'plan' => 'pro', 'message' => 'I am very stiff and inflexible. Do you offer yoga or stretching classes for absolute beginners?'],
            ['name' => 'Tom Lee', 'email' => 'tom.lee@email.com', 'phone' => '555-0105', 'goal' => 'improve_endurance', 'plan' => 'elite', 'message' => 'Training for a marathon and need to improve my overall endurance. Looking for a comprehensive program.'],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
