<?php

namespace App\Http\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\HotelAttribute;
use Illuminate\Support\Facades\Session;

class AttributeService
{
    public function getAll()
    {
        return Attribute::all();
    }

    public function getAttributeByCode($attr_code)
    {
        return Attribute::where("attribute_code", $attr_code)->first();
    }

    public function getAttributeValues($attr_code)
    {
        $attribute = $this->getAttributeByCode($attr_code);

        if ($attribute) {
            return AttributeValue::where("attribute_id", $attribute->id)->get();
        }

        return false;
    }

    public function getAttributeOption($id)
    {
        return AttributeValue::where("id", $id)->first();
    }

    public function validateAttributeRequest($request)
    {
        $data = $request->all();

        return array_merge($data, [
            'active' => $data['active'] ? 1 : 0,
            'type' => (int) $data['type']
        ]);
    }

    public function create($request)
    {
        try{
            $data = $this->validateAttributeRequest($request);
            $attribute = Attribute::create($data);

            $this->insertAttributeValues($request->attribute_values, $attribute);

            Session::flash("success","Create Attribute Success");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $attribute)
    {
        try{
            $data = $this->validateAttributeRequest($request);
            $attribute->fill($data);
            $attribute->save();

            $this->updateAttributeValues($request->attribute_values, $attribute);

            Session::flash("success","Update Attribute Success");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function insertAttributeValues($values, $attribute)
    {
        if(!is_array($values) || is_null($values) || empty($values)) return false;

        foreach($values as $key => $item){
            if($item['delete'] != 1){
                $attribute->values()->firstOrCreate([
                    'label' => $item['label'],
                    'value' => $item['value']
                ]);
            }
        }
    }

    public function updateAttributeValues($values, $attribute)
    {
        if(!is_array($values) || is_null($values) || empty($values)) return false;

        foreach($values as $key => $item){
            $attributeValueInstance = AttributeValue::where('id', $key)->first();

            if($attributeValueInstance){
                if($item['delete'] == 1){
                    $attributeValueInstance->delete();
                }else{
                    $attributeValueInstance->fill($item);
                    $attributeValueInstance->save();
                }
            }else{
                if($item['delete'] != 1){
                    $attribute->values()->create([
                        'label' => $item['label'],
                        'value' => $item['value'],
                        'image' => $item['image']
                    ]);
                }
            }
        }
    }

    public function delete($id)
    {
        $attribute = Attribute::where('id', $id)->first();
        $attributeValue = AttributeValue::where('attribute_id', $id)->get();

        foreach($attributeValue as $key => $item){
            HotelAttribute::where('option_id', $item->id)->delete();
        }

        AttributeValue::where('attribute_id', $id)->delete();
        $attribute->delete();
    }
}
