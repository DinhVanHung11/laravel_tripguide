<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'tag_id'
    ];
}
