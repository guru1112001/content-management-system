<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Batch::create(['name' => 'Batch A']);
        Batch::create(['name' => 'Batch B']);
    }
}
