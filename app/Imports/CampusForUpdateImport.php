<?php

namespace App\Imports;

use App\Models\Campus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CampusForUpdateImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   

        

        $campus = Campus::where('id', $row['campus_id'])->first();

        if($campus){
            $campus->update([
                'name'=> $row['campus_name']
            ]);
        }else{
          
        }
    }
}