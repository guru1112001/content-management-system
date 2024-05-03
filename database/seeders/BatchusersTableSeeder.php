<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\batch_user;

class BatchusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        batch_user::create(['batch_id' => 1, 'user_id' => 1]);
    batch_user::create(['batch_id' => 2, 'user_id' => 2]);
    }
}
