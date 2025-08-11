<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['*'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
