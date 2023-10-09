<?php

namespace App\Exports;

use App\Models\Campus;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class CourseExport implements FromView {
 
    public function view(): View
    {

        $courseData = Course::all();
        
        if ($courseData->isEmpty()) {

            $courseData = [
                (object) [
                    'name' => 'Bachelor of Science in Information Technology',
                    'sub_name' => 'BSIT',
                    'campus_id' => 1, // Replace with the appropriate campus_id
                ],
                (object) [
                    'name' => 'Bachelor of Science in Computer Science',
                    'sub_name' => 'BSCS',
                    'campus_id' => 2, // Replace with the appropriate campus_id
                ],
                (object) [
                    'name' => 'Bachelor of Science in Information System',
                    'sub_name' => 'BSIS',
                    'campus_id' => 2, // Replace with the appropriate campus_id
                ],
                // Add more default courses as objects as needed
            ];

        }
        return view('exports.courses', [
            'items' => $courseData,
            'campuses' => Campus::all(),
        ]);
    }
}
