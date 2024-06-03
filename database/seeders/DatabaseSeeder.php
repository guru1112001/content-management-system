<?php

namespace Database\Seeders;
// use Illuminate\Database\Seeder;
use App\Models\City;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuestionBankType;
use Database\Seeders\HolidaySeeder;
use Database\Seeders\CalendarSeeder;
use App\Models\QuestionBankDifficulty;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BatchesTableSeeder::class,
            CoursesTableSeeder::class,
            BatchCoursesTableSeeder::class,
            // BatchusersTableSeeder::class,
            
            CalendarSeeder::class,
            HolidaySeeder::class,
            QuestionBankType::create(['name' => 'MCQ - Single Correct']),
            QuestionBankType::create(['name' => 'MCQ - Multiple Correct']),
            
            QuestionBankDifficulty::create(['name' => 'Easy']),
            QuestionBankDifficulty::create(['name' => 'Medium']),
            QuestionBankDifficulty::create(['name' => 'Hard']),
            

        ]);
        // \App\Models\City::create(['name' => 'City 1']);
        // \App\Models\City::create(['name' => 'City 2']);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
