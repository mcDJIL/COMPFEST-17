<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealType;
use Carbon\Carbon;

class MealTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Breakfast', 'Lunch', 'Dinner'];
        $time = Carbon::now();

        foreach ($types as $i => $type) {
            MealType::create([
                'name' => $type,
                'created_at' => $time->copy()->addSeconds($i),
                'updated_at' => $time->copy()->addSeconds($i),
            ]);
        }
    }
}