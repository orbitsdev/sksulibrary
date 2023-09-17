<?php

namespace App\Imports;

use App\Models\Campus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CampusImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   

        
       
        $campus = Campus::where('name', $row['campus_name'])->first();

        if($campus){

        }else{
            return new Campus([
                'name'=> $row['campus_name']
            ]);

        }

    }
}
