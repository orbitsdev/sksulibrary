<?php

namespace App\Imports;

use App\Models\Campus;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseForUpdateImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $course = Course::where('id', $row['course_id'])->first();
        $campusExist = Campus::find($row['campus_id']); 
        
        
        $campus= null;
        if($campusExist){
            $campus = $campusExist->id;
        }


        if($course){
            $course->update([
            'name'=> $row['course_name'],
            'campus_id'=> $campus,
            ]);
           
        }else{


        }
    }
}
