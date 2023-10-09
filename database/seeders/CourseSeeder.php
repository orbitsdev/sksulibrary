<?php

namespace Database\Seeders;

use App\Models\Campus;
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
            [
               'course'=> 'Bachelor Of Sciene in Information Technology',
               'sub_name'=> 'BSIT',

            ],
            [
                'course'=> 'Bachelor Of Sciene in Biology',
                'sub_name'=>'BIOLOGY',
            ],
            [

                'course'=>'Bachelr of Science In Elementary Education',
                'sub_name'=>'BSED',

            ],
            [

                'course'=>'Bachelr of Science In Secondat Education',
                'sub_name'=>'BSSD',

            ],
           

        ];

        foreach ($course as $key => $value) {
            Course::create([
                'campus_id'=> Campus::inRandomOrder()->first()->id,
                'name' => $value['course'],
                'sub_name' => $value['sub_name'],
            ]);
        }
    }
}
