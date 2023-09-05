<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class StudentImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    { 

        $student = Student::where('id_number', $row['id_number'])->first();

        if($student){

        }else{
            return new Student([
            'id_number' => $row['id_number'],
            'first_name' =>$row['first_name'],
            'last_name' => $row['last_name'],
            'middle_name' => $row['middle_name'],
            'sex' => $row['sex'],
            'contact_number'=>$row['contact_number'],
            'street_address' => $row['street_address'],
            'city' => $row['city'],
            'country'=> $row['country'],
            'state'=>$row['state'],
            'postal_code'=>$row['postal_code'],
            'campus_id'=> $row['campus_id'],
            'course_id' => $row['course_id'],
            'barcode'=>$row['barcode'],
            'status'=>$row['status'],
            'year'=>$row['year'],
            'profile'=>null,
            'school_id'=>null,
            'two_by_two'=>null,    
            ]);
        }
        
       
    }
}
