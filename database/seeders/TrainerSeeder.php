<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = [
            [
                'name' => 'Marcus Johnson',
                'photo' => null,
                'specialty' => 'Strength & Conditioning',
                'bio' => 'Former competitive powerlifter with over 10 years of coaching experience. Marcus specializes in strength training, form correction, and helping clients break through plateaus.',
                'certifications' => ['NSCA-CSCS', 'CrossFit Level 2', 'Precision Nutrition Level 1'],
                'social_links' => ['instagram' => 'https://instagram.com/marcusjohnson', 'twitter' => 'https://twitter.com/marcusjohnson'],
            ],
            [
                'name' => 'Sarah Chen',
                'photo' => null,
                'specialty' => 'HIIT & Cardio',
                'bio' => 'Certified fitness instructor and former track athlete. Sarah brings high energy and science-backed HIIT protocols to help clients maximize fat loss and cardiovascular health.',
                'certifications' => ['ACE Certified Personal Trainer', 'HIIT Specialist', 'CPR/AED'],
                'social_links' => ['instagram' => 'https://instagram.com/sarachen_fit', 'twitter' => 'https://twitter.com/sarachen_fit'],
            ],
            [
                'name' => 'David Rivera',
                'photo' => null,
                'specialty' => 'Yoga & Mobility',
                'bio' => 'RYT-500 certified yoga instructor with a background in sports therapy. David combines traditional yoga philosophy with modern mobility science for optimal results.',
                'certifications' => ['RYT-500', 'Yoga Alliance Certified', 'FASCIQ Level 1'],
                'social_links' => ['instagram' => 'https://instagram.com/davidrivera_yoga', 'twitter' => 'https://twitter.com/davidrivera_yoga'],
            ],
            [
                'name' => 'Emily Torres',
                'photo' => null,
                'specialty' => 'Nutrition & Wellness',
                'bio' => 'Registered Dietitian and certified personal trainer. Emily takes a holistic approach to fitness, focusing on nutrition, recovery, and sustainable lifestyle changes.',
                'certifications' => ['RD', 'CSSD', 'Precision Nutrition Level 2'],
                'social_links' => ['instagram' => 'https://instagram.com/emilytorres_nutrition', 'twitter' => 'https://twitter.com/emilytorres_nutrition'],
            ],
        ];

        foreach ($trainers as $trainer) {
            Trainer::create($trainer);
        }
    }
}
