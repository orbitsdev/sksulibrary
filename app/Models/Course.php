<?php

namespace App\Models;

use App\Models\User;
use App\Models\Campus;
use App\Models\UserInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function users()
    {
        return $this->hasMany(User::class, 'course_id');
    }

    public function campus(){
        return $this->belongsTo(Campus::class);
    }

}
