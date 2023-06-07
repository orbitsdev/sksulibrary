<?php

namespace App\Models;

use App\Models\DayLogin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DayRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function daylogins(){

        return $this->hasMany(DayLogin::class, 'day_record_id');
    }


}
