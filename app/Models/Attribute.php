<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public const ONESELECT = "1";
    public const MULTISELECT = "2";

    protected $fillable = [
        'label',
        'attribute_code',
        'active',
        'type'
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }
}
