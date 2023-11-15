<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function capitals()
    {
        return $this->hasMany(CountryCapital::class, 'country_id');
    }

    public function flags()
    {
        return $this->hasOne(CountryFlag::class,'country_id');
    }

    public function maps()
    {
        return $this->hasOne(CountryMap::class,'country_id');
    }

    public function languages()
    {
        return $this->hasMany(CountryLanguage::class, 'country_id');
    }
}
