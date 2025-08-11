<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomTripQuery extends Model
{
    // use HasFactory;
    protected $fillable = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
