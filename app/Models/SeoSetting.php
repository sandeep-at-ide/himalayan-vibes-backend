<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
     use HasFactory;
protected $guarded = [];
    protected $casts = [
        'custom_fields' => 'array',
    ];

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
