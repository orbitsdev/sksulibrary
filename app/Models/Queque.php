<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queque extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function transaction(){
        return $this->hasOne(Transaction::class);
    }
    
}
