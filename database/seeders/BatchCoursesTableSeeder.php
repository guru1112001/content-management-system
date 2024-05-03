<?php

namespace Database\Seeders;

use App\Models\BatchCourse;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BatchCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BatchCourse::create(['batch_id' => 1, 'course_id' => 1]);
    BatchCourse::create(['batch_id' => 1, 'course_id' => 2]);
    }
}
