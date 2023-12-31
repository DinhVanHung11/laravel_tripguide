<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryFlag extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'flag_png',
        'flag_svg'
    ];
}
