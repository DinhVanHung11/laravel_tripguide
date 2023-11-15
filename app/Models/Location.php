<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public const NO_BEST_PLACE = 0;
    public const BEST_PLACE = 1;

    protected $fillable = [
        'name',
        'image',
        'post_code',
        'is_best'
    ];
}
