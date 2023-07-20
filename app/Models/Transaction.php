<?php

namespace App\Models;

use App\Models\Queque;
use App\Models\Teller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function queque()
    {
        return $this->belongsTo(Queque::class);
    }

    public function teller()
    {
        return $this->belongsTo(Teller::class);
    }
}
