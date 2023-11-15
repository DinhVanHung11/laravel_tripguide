<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'google_map',
        'open_street_map'
    ];
}
