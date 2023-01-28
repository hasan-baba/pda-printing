<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['da_nb', 'trip_id', 'status', 'data', 'advanced_payment', 'payment_reference', 'statement', 'currency_id', 'bank_id'];
    protected $casts = [
        'data' => 'array',
    ];
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
