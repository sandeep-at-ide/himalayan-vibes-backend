<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public function seoSetting()
    {
        return $this->belongsTo(SeoSetting::class, 'seo_id');
    }
}
