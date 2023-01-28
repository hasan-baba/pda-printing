<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function cur()
    {
        return $this->belongsTo(Currency::class,'currency', 'id');
    }
}
