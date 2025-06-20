<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealPlan;
use Carbon\Carbon;

class MealPlanSeeder extends Seeder
{
    public function run(): void
    {
        $mealPlans = [
            [
                'name' => 'Diet Plan',
                'price' => 30000,
                'description' => 'Low-calorie meals tailored for weight management. Perfect for those aiming to eat light and stay healthy.',
                'image' => 'assets/images/diet.png',
            ],
            [
                'name' => 'Royal Plan',
                'price' => 60000,
                'description' => 'Premium, balanced meals with exclusive ingredients and full portions. A luxurious choice for your daily nutrition.',
                'image' => 'assets/images/royal.png',
            ],
            [
                'name' => 'Protein Plan',
                'price' => 40000,
                'description' => 'High-protein meals to support muscle growth and active lifestyles. Ideal for gym-goers and fitness enthusiasts.',
                'image' => 'assets/images/protein.png',
            ],
        ];

        $time = Carbon::now();

        foreach ($mealPlans as $i => $plan) {
            MealPlan::create(array_merge($plan, [
                'created_at' => $time->copy()->addSeconds($i),
                'updated_at' => $time->copy()->addSeconds($i),
            ]));
        }
    }
}