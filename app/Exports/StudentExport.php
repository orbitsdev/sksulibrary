<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    public function view(): View
    {   

        $data = Student::all();

        if(count($data) > 0){
            $students = $data;
        } else{
            $students = [
                (object) [
                    'id' => 1,
                    'id_number' => '2021-0001',
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'middle_name' => 'Smith',
                    'sex' => 'Male',
                    'contact_number' => '123-456-7890',
                    'street_address' => '123 Main Street',
                    'city' => 'Example City',
                    'country' => 'Example Country',
                    'postal_code' => '12345',
                    'campus_id' => 1, // Replace with the appropriate campus_id
                    'course_id' => 1, // Replace with the appropriate course_id
                    'status' => 'Active',
                    'year' => '1st Year',
                    // 'profile' => 'path/to/profile-image.jpg',
                    // 'school_id' => 'SCHOOL001',
                    // 'two_by_two' => 'path/to/two-by-two-image.jpg',
                ],
                (object) [
                    'id' => 2,
                    'id_number' => '2021-0002',
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'middle_name' => 'Smith',
                    'sex' => 'Female',
                    'contact_number' => '987-654-3210',
                    'street_address' => '456 Elm Street',
                    'city' => 'Another City',
                    'country' => 'Another Country',
                    'postal_code' => '54321',
                    'campus_id' => 2, // Replace with the appropriate campus_id
                    'course_id' => 2, // Replace with the appropriate course_id
                    'status' => 'Inactive',
                    'year' => '2nd Year',
                    'profile' => 'path/to/another-profile-image.jpg',
                    // 'school_id' => 'SCHOOL002',
                    // 'two_by_two' => 'path/to/another-two-by-two-image.jpg',
                ],
                (object) [
                    'id' => 3,
                    'id_number' => '2021-0003',
                    'first_name' => 'Alice',
                    'last_name' => 'Johnson',
                    'middle_name' => 'Brown',
                    'sex' => 'Female',
                    'contact_number' => '555-123-4567',
                    'street_address' => '789 Oak Street',
                    'city' => 'Yet Another City',
                    'country' => 'Yet Another Country',
                    'postal_code' => '67890',
                    'campus_id' => 3, // Replace with the appropriate campus_id
                    'course_id' => 3, // Replace with the appropriate course_id
                    'status' => 'Active',
                    'year' => '3rd Year',
                    // 'profile' => 'path/to/alice-profile-image.jpg',
                    // 'school_id' => 'SCHOOL003',
                    // 'two_by_two' => 'path/to/alice-two-by-two-image.jpg',
                ],
            ];
            
     
                    
        }

        return view('exports.students', [
            'items' => $students
        ]);
    }
}
