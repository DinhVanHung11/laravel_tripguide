<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_name',
        'price',
        'price_sale',
    ];

    public function features()
    {
        return $this->hasMany(OfferHotelRoom::class,'room_id');
    }
}
