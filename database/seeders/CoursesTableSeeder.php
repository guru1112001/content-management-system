<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create(['name' => 'Course 1', 'course_type' => 'Type A' ,'short_description'=>'abcd']);
    Course::create(['name' => 'Course 2', 'course_type' => 'Type B','short_description'=>'abcd']);
    }
}
