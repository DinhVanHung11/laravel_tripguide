<?php

namespace App\Helpers;

use App\Http\Services\AttributeService;
use App\Models\Attribute;
use App\Models\Location;

class HotelHelper
{
    public function getType($options)
    {
        $attribute_type = Attribute::where("attribute_code", "type")->first();

        foreach ($options as $key => $value) {
            if($value->attribute_id == $attribute_type->id) {
                return ucfirst($value->label);
            }
        }
    }

    public function getLocation($location_id)
    {
        $location = Location::where("id", $location_id)->first();
        if($location) {
            return ucfirst($location->name);
        }

        return '';
    }
}
