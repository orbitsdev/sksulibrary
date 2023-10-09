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
                    'id_number' => 'aBcDeFgHiJkLmNoPqRs1T2U3V4W5X6Y7Z2', // Changed to an integer
                    'first_name' => 'John',
                    'middle_name' => 'Smith',
                    'last_name' => 'Doe',
                    'sex' => 'Male',
                    'contact_number' => '9231234567',
                    'street_address' => '123 Main Street',
                    'home_address' => '123 Main Street',
                    'city' => 'Example City',
                    'country' => 'Example Country',
                    'postal_code' => '12345',
                    'campus_id' => 1, // Replace with the appropriate campus_id
                    'course_id' => 1, // Replace with the appropriate course_id
                    'status' => 'Active',
                    'year' => '1st Year',
                    'profile' => 'path/to/profile-image.jpg',
                    'guardian'=> 'Guardian 1',   
                    'guardian_contact_number'=> '9231234567',   
                    'valid_from'=>now()->year,
                    'valid_until'=>now()->addYear()->year,
                    
                   
                ],
                (object) [
                    'id_number' => 'aBcDeFgHiJkLmNoPqRs1T2U3V4W5X6Y7Z3', // Changed to an integer
                    'first_name' => 'Kath',
                    'middle_name' => 'Kristine Dumangin',
                    'last_name' => 'Anjan',
                    'sex' => 'Female',
                    'contact_number' => '9231234567',
                    'street_address' => '456 Elm Street',
                    'home_address' => '456 Elm Street',
                    'city' => 'Another City',
                    'country' => 'Another Country',
                    'postal_code' => '54321',
                    'campus_id' => 2, // Replace with the appropriate campus_id
                    'course_id' => 2, // Replace with the appropriate course_id
                    'status' => 'Inactive',
                    'year' => '2nd Year',
                    'profile' => 'path/to/another-profile-image.jpg',
                    'guardian'=> 'Guardian 2',   
                    'guardian_contact_number'=> '9231234567',
                    'valid_from'=>now()->year,
                    'valid_until'=>now()->addYear()->year,
                  
                ],
                (object) [
                    'id_number' => 'aBcDeFgHiJkLmNoPqRs1T2U3V4W5X6Y7Z4', // Changed to an integer
                    'first_name' => 'Alice',
                    'middle_name' => 'Brown',
                    'last_name' => 'yow',
                    'sex' => 'Female',
                    'contact_number' => '9231234567',
                    'street_address' => '789 Oak Street',
                    'home_address' => '789 Oak Street',
                    'city' => 'Yet Another City',
                    'country' => 'Yet Another Country',
                    'postal_code' => '67890',
                    'campus_id' => 3, // Replace with the appropriate campus_id
                    'course_id' => 3, // Replace with the appropriate course_id
                    'status' => 'Active',
                    'year' => '3rd Year',
                    'profile' => 'path/to/alice-profile-image.jpg',
                    'guardian'=> 'Guardian 3',   
                    'guardian_contact_number'=> '9231234567',
                    'valid_from'=>now()->year,
                    'valid_until'=>now()->addYear()->year,
                   
                ],
            ];
            
            
     
                    
        }

        return view('exports.students', [
            'items' => $students
        ]);
    }
}
