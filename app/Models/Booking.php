<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public const CANCELED = 0;
    public const PENDING = 1;
    public const DEPOSITED = 2;
    public const COMPLETED = 3;

    protected $fillable = [
        'booking_code',
        'user_id',
        'check_in',
        'check_out',
        'hotel_id',
        'room_id',
        'total_price',
        'payment',
        'adults',
        'children',
        'infants',
        'status'
    ];

    public function features()
    {
        return $this->hasMany(BookingFeature::class, 'booking_id');
    }
}
