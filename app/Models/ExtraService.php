<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    use HasFactory;

    public const ISCALCULATEPEOPLE = 1;
    public const NOCALCULATEPEOPLE = 0;

    protected $fillable = [
        'label',
        'price',
    ] ;
}
