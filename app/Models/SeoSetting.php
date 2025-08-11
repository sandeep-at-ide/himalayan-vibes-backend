<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
     use HasFactory;

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'accessed_by');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'seo_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'seo_id');
    }
}
