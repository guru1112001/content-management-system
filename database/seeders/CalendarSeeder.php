<?php

namespace Database\Seeders;

use App\Models\Calendar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calendar::create([
            'teams_id' => 2,
            'batch_id' => 2,
            'branch_id'=>2,
            'tutor_id' => 2,
            'curriculum_id' => 2,
            'classroom_id' => 2,
            'start_time' => now(),
            'end_time' => now()->addHours(1),
        ]);
    }
}
