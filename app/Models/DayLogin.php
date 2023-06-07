<?php

namespace App\Models;

use App\Models\Student;
use App\Models\DayLogout;
use App\Models\DayRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DayLogin extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function dayRecord(){
        return $this->belongsTo(DayRecord::class, 'day_record_id');
    }
    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function logout(){
        return $this->hasOne(DayLogout::class, 'day_login_id');
    }
}
