<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function getUserAttribute()
    {
        return $this->booking?->user;
    }

}
