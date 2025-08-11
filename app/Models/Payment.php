<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // use HasFactory;
    protected $fillable = ['*'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
