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
       
        dd($row);
        $course = Course::where('id', $row['course_id'])->first();
        $campusExist = Campus::find($row['campus_id']); 
        
        
        $campus= null;
        if($campusExist){
            $campus = $campusExist->id;
        }


        if($course){
            $course->update([
                'name'=> $row['course_name'],
                'sub_name'=> $row['prefix'],
                'campus_id'=> $campus,
            ]);

            $course->save();

        }else{
            return new Course([
                'name'=> $row['course_name'],
                'sub_name'=> $row['prefix'],
                'campus_id'=> $campus,
            ]);

        }

    }
}
