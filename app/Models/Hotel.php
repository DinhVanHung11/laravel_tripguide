<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public const HOTEL= 1;
    public const APERTMENTS= 2;
    public const RESORT= 3;
    public const VILLA= 4;
    public const HOMESTAY= 3;

    protected $fillable = [
        "name",
        "image",
        "description",
        'location_id',
        "rating",
        "price",
        "room",
        "distance",
        "position"
    ];

    public function images()
    {
        return $this->hasMany(HotelImage::class, 'hotel_id');
    }

    public function optionsAttributes()
    {
        return $this->belongsToMany(AttributeValue::class,'hotel_attributes', 'hotel_id', 'option_id');
    }

    public function advancePrices()
    {
        return $this->hasMany(AdvancePrice::class, 'hotel_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'hotel_tags', 'hotel_id', 'tag_id');
    }

    public function extraFeatures()
    {
        return $this->belongsToMany(ExtraService::class,'hotel_extra_services','hotel_id', 'service_id');
    }

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class, 'hotel_id');
    }
}
