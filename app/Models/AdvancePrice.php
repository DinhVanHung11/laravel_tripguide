<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'price',
        'price_sale',
        'number_people'
    ];
}
