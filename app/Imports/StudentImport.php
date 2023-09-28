<?php

namespace App\Imports;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
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

        try{
            DB::beginTransaction();
            $student = Student::where('id_number', $row['id_number'])->first();
            $campus = null;
            $course = null;
            $campusExist = Campus::find($row['campus_id']);
            $courseExist = Course::find($row['course_id']); 
            if($campusExist){
                $campus = $campusExist->id;
            }
            if($courseExist){
                $course = $courseExist->id;
            }

            if($student){
                $student->update([
                'id_number' => $row['id_number'],
                'first_name' =>$row['first_name'],
                'last_name' => $row['last_name'],
                'middle_name' => $row['middle_name'],
                'sex' => $row['sex'],
                'contact_number'=>$row['phone_number'],
                'street_address' => $row['street_address'],
                'home_address' => $row['home_address'],
                'city' => $row['city'],
                'country'=> $row['country'],
                'postal_code'=>$row['postal_code'],
                'campus_id'=> $campus,
                'course_id' => $course,
                'year'=>$row['year'],
                'profile'=>null,
                'school_id'=>null,
                'two_by_two'=>null,   
                ]);
                $student->save();
            }else{
    
                return new Student([
                'id_number' => $row['id_number'],
                'first_name' =>$row['first_name'],
                'last_name' => $row['last_name'],
                'middle_name' => $row['middle_name'],
                'sex' => $row['sex'],
                'contact_number'=>$row['phone_number'],
                'street_address' => $row['street_address'],
                'home_address' => $row['home_address'],
                'city' => $row['city'],
                'country'=> $row['country'],
                'postal_code'=>$row['postal_code'],
                'campus_id'=> $campus,
                'course_id' => $course,
                'year'=>$row['year'],
                'profile'=>null,
                'school_id'=>null,
                'two_by_two'=>null,    
                ]);
            }
            DB::commit(); 

        }catch(QueryException $e){
            DB::rollBack(); 
        }
       
        
       
    }
}
