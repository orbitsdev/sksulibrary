<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teller extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
