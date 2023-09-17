<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function students(){
        return $this->hasMany(Student::class, 'campus_id');
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
