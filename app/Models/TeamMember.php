<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    public function packages()
    {
        return $this->hasMany(Package::class, 'created_by');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    public function seoSettings()
    {
        return $this->hasMany(SeoSetting::class, 'accessed_by');
    }
}
