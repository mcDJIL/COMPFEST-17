<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryDay;
use Carbon\Carbon;

class DeliveryDaySeeder extends Seeder
{
    public function run(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $time = Carbon::now();

        foreach ($days as $i => $day) {
            DeliveryDay::create([
                'name' => $day,
                'created_at' => $time->copy()->addSeconds($i),
                'updated_at' => $time->copy()->addSeconds($i),
            ]);
        }
    }
}