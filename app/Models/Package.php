<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
protected $guarded = [];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class, 'created_by');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'package_id');
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'package_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'location');
    }

    public function seoSettings()
    {
        return $this->belongsTo(SeoSetting::class, 'seo_id');
    }
}
