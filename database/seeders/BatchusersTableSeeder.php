<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BatchUser;

class BatchusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BatchUser::create(['batch_id' => 1, 'user_id' => 1]);
    BatchUser::create(['batch_id' => 2, 'user_id' => 2]);
    }
}
