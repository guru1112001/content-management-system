<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            ['name' => 'New Year',  'date' => '2024-05-02'],
            ['name' => 'Independence Day', 'date' => '2024-05-02'],
            
        ];
        foreach ($holidays as $holidayData) {
            Holiday::create($holidayData);
        }
    }
}
