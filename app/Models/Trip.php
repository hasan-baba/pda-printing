<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function enquiry()
    {
        return $this->hasOne(Enquiry::class, 'trip_id', 'id');
    }
    public function lbenquiry()
    {
        return $this->hasOne(LebaneseEnquiry::class, 'trip_id', 'id');
    }
}
