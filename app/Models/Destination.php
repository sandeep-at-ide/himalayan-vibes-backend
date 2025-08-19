<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;
protected $guarded = [];

    public function packages()
    {
        return $this->hasMany(Package::class, 'location');
    }
}
