<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
//    use HasFactory;
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(TeamMember::class, 'author_id');
    }

    public function seoSetting()
    {
        return $this->belongsTo(SeoSetting::class, 'seo_id');
    }
}
