<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    // Use the Spatie HasRoles trait
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'guard_name',
    ];

    // Optionally, you can define relationships and custom methods if needed

    // Example: A role can have many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
