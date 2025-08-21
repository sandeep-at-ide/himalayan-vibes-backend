<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
    ];

    // A category can have many destinations
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    // A category can have many packages
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
