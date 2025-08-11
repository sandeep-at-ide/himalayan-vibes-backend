<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    public function packages()
    {
        return $this->hasMany(Package::class, 'location');
    }
}
