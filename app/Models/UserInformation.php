<?php

namespace App\Models;

use App\Models\User;
use App\Models\Campus;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInformation extends Model
{
    use HasFactory;

    protected $guarded = [];

  


    public function campus(){
        return $this->belongsTo(Campus::class, 'campus_id');
    }

   

    
}
