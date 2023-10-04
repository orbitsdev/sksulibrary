<?php

namespace App\Models;

use App\Models\DayLogin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DayLogout extends Model
{
    use HasFactory;

    public function login(){
        return $this->belongsTo(DayLogin::class);
    }
}
