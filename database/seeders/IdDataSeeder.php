<?php

namespace Database\Seeders;

use App\Models\IdData;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IdData::create([
            'director' =>'ALNE D. QUINOVERA, Phd',
            'title' => 'Director, Library Service & Museum',
            'valid_from' => now()->year,
            'valid_until' => now()->addYear()->year,
        ]);
    }
}
