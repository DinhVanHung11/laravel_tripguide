<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferHotelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'feature_id'
    ];
}
