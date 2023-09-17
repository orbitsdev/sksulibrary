<?php

namespace App\Imports;

use App\Models\Campus;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CourseImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
       
    
        $name = Course::where('name', $row['course_name'])->first();

        $courseExist = Campus::find($row['campus_id']); 
        
        $campus= null;
        if($courseExist){
            $campus = $courseExist->id;
        }


        if($name){
        }else{
            return new Course([
                'name'=> $row['course_name'],
                'campus_id'=> $campus,
            ]);

        }

    }
}
