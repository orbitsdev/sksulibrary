<?php

namespace App\Models;

use App\Models\Campus;
use App\Models\Course;
use App\Models\DayLogin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function logins(){
        return $this->hasMany(DayLogin::class, 'student_id');
    }


    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function campus(){
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    
}
