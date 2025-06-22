<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MealPlanSeeder::class,
            MealTypeSeeder::class,
            DeliveryDaySeeder::class,
            AdminUserSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}