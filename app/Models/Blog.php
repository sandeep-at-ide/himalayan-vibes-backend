<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
   use HasFactory;

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'author_id');
    }

    public function seoSetting()
    {
        return $this->belongsTo(SeoSetting::class, 'seo_id');
    }
}
