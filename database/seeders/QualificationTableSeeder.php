<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QualificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Qualification::create(['name' => 'bca graducate']);
        Qualification::create(['name' => '10th passed']);
        Qualification::create(['name' => '12th passed']);
    }
}
