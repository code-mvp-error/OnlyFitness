<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Strength Training',
                'description' => 'Build raw power and muscle with our comprehensive strength training program. Focus on compound lifts, progressive overload, and proper form to maximize your gains.',
                'icon' => '🏋️',
                'duration' => '12 weeks',
                'intensity' => 'Intermediate',
                'schedule' => '4x/week',
                'features' => ['Compound Lifts', 'Progressive Overload', 'Form Coaching', 'Accessory Work', 'Deload Weeks'],
            ],
            [
                'name' => 'HIIT',
                'description' => 'High-Intensity Interval Training designed to torch calories and boost cardiovascular endurance. Alternating bursts of intense exercise with recovery periods.',
                'icon' => '🔥',
                'duration' => '8 weeks',
                'intensity' => 'Advanced',
                'schedule' => '5x/week',
                'features' => ['Interval Training', 'Calorie Torching', 'Endurance Building', 'Heart Rate Zones', 'Recovery Protocols'],
            ],
            [
                'name' => 'Personal Training',
                'description' => 'One-on-one coaching tailored to your specific goals. Get personalized workout plans, nutritional guidance, and accountability from our expert trainers.',
                'icon' => '🎯',
                'duration' => 'Flexible',
                'intensity' => 'All Levels',
                'schedule' => 'Flexible',
                'features' => ['Custom Plans', 'Nutrition Guidance', 'Form Correction', 'Progress Tracking', 'Accountability'],
            ],
            [
                'name' => 'Yoga & Flexibility',
                'description' => 'Improve flexibility, balance, and mental focus. Our yoga program combines traditional poses with modern techniques for holistic wellness.',
                'icon' => '🧘',
                'duration' => 'Ongoing',
                'intensity' => 'Beginner',
                'schedule' => '3x/week',
                'features' => ['Vinyasa Flow', 'Breath Work', 'Meditation', 'Mobility Drills', 'Relaxation'],
            ],
            [
                'name' => 'Nutrition Coaching',
                'description' => 'Transform your body through proper nutrition. Learn meal planning, macro tracking, and sustainable eating habits to complement your training.',
                'icon' => '🥗',
                'duration' => '8 weeks',
                'intensity' => 'All Levels',
                'schedule' => 'Weekly check-ins',
                'features' => ['Meal Planning', 'Macro Tracking', 'Supplement Advice', 'Eating Habits', 'Sustainability'],
            ],
            [
                'name' => 'Group Classes',
                'description' => 'High-energy group workouts that combine strength, cardio, and functional movements. Stay motivated with our supportive community atmosphere.',
                'icon' => '👥',
                'duration' => 'Ongoing',
                'intensity' => 'All Levels',
                'schedule' => '6x/week',
                'features' => ['Community Energy', 'Functional Training', 'Strength & Cardio', 'Motivation', 'Variety'],
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
