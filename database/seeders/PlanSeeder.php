<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'price_monthly' => 299.00,
                'price_yearly' => 2990.00,
                'features' => [
                    'Access to gym facilities',
                    'Standard equipment usage',
                    'Locker room access',
                    'Free fitness assessment',
                ],
                'is_popular' => false,
            ],
            [
                'name' => 'Pro',
                'price_monthly' => 599.00,
                'price_yearly' => 5990.00,
                'features' => [
                    'Everything in Basic',
                    'Unlimited group classes',
                    '1 personal training session/month',
                    'Nutrition consultation',
                    'Access to sauna & steam room',
                ],
                'is_popular' => true,
            ],
            [
                'name' => 'Elite',
                'price_monthly' => 999.00,
                'price_yearly' => 9990.00,
                'features' => [
                    'Everything in Pro',
                    '4 personal training sessions/month',
                    'Custom meal plans',
                    'Priority booking',
                    'Guest passes (2/month)',
                    'Exclusive member events',
                ],
                'is_popular' => false,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
