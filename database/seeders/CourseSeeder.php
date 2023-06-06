<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course = [
            'BSIT',
            'BIOLOGY',
            'SECONDARY TEACHER',
            'BSBE',
        ];

        foreach ($course as $key => $value) {
            Course::create([
                'name' => $value,
            ]);
        }
    }
}
