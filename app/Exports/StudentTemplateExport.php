<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentTemplateExport implements FromView
{
    public function view(): View
    {
        return view('exports.accounts', [
            'collections' => [
                (object) [
                    'id' => 1,
                    'id_number' => '2021-0001',
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'middle_name' => 'Smith',
                    'role_id' => 1,
                    'school_year_id' => 1,
                    'department_id' => 1,
                    'course_id' => 1,
                    'section_id' => 1,

                ],
                
 
            ]
        ]);
    }
}
