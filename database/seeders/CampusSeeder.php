<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campuses = ['Isulan', 'Access', 'Tacurong'];

        foreach ($campuses as $campus) {
            Campus::create([
                'name' => $campus,
            ]);
        }
    }
}
