<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

protected $guarded = [];
    protected $casts = [
        'custom_fields' => 'array',
    ];

    public function seoSetting()
    {
        return $this->belongsTo(SeoSetting::class, 'seo_id');
    }
}
