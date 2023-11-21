<?php

namespace App\Http\Services;

use App\Models\AdvancePrice;
use App\Models\Hotel;
use App\Models\HotelImage;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Services\CountryService;
use App\Models\HotelExtraService;
use App\Models\HotelRoom;
use App\Models\HotelTag;
use App\Models\OfferHotelRoom;

class HotelService
{
    protected $countryService;
    protected $attributeService;

    public function __construct()
    {
        $this->countryService = new CountryService;
        $this->attributeService = new AttributeService;
    }

    public function getLimit($limit = 20)
    {
        return Hotel::orderByDesc("id")->paginate($limit);
    }

    public function getRandomLimit($limit = 10)
    {
        return Hotel::inRandomOrder()->limit($limit)->get();
    }

    public function create($request)
    {
        try{
            $data = $request->input();
            $hotel = Hotel::create($data);   //Create Hotel

            $this->insertHotelImages($request->image_gallery, $hotel);  //Insert Images
            $this->insertHotelAttributes($request->attribute_option, $hotel);  //Insert Attribute Options
            $this->insertHotelAdvancePrices($request->price_options, $hotel);  //Insert Advance Price
            $this->insertHotelTags($request->tags, $hotel);  //Insert Hotel Tags
            $this->insertHotelExtraFeature($request->extra_features, $hotel);  //Insert Hotel Extra Feature
            $this->insertHotelRooms($request->room_options, $hotel);  //Insert Rooms

            Session::flash("success","Create Hotel Successfull");
        }catch(Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function insertHotelImages($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        foreach($data as $value){
            $hotel->images()->create([
                'image' => $value
            ]);
        }
    }

    public function insertHotelAttributes($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        $hotel->optionsAttributes()->attach($data);
    }

    public function insertHotelTags($data, $hotel)
    {
        if(is_null($data)) return false;

        foreach($data as $tag){
            HotelTag::create([
                'hotel_id' => $hotel->id,
                'tag_id' => $tag
            ]);
        }
    }

    public function insertHotelExtraFeature($data, $hotel)
    {
        if(is_null($data)) return false;

        foreach($data as $feature){
            HotelExtraService::create([
                'hotel_id' => $hotel->id,
                'service_id' => $feature
            ]);
        }
    }

    public function insertHotelAdvancePrices($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        foreach($data as $value){
            if($value['delete'] != 1){
                $hotel->advancePrices()->create([
                    'price' => $value['price'],
                    'price_sale' => $value['price_sale'],
                    'number_people' => $value['people']
                ]);
            }
        }
    }

    public function insertHotelRooms($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        foreach($data as $value){
            if($value['delete'] != 1){
                $roomInstance = HotelRoom::create([
                    'hotel_id' => $hotel->id,
                    'room_name' => $value['room_name'],
                    'price' => $value['price'],
                    'price_sale' => $value['price_sale'],
                ]);

                $features = $value['room_features'];
                if(is_null($features) || !is_array($features) || empty($features)) break;
                foreach($features as $feature_id){
                    OfferHotelRoom::create([
                        'room_id' => $roomInstance->id,
                        'feature_id' => $feature_id
                    ]);
                }
            }
        }
    }

    public function update($request, $hotel)
    {
        try{
            $data = $request->input();
            $hotel->fill($data);
            $hotel->save($data);

            $this->updateHotelImages($request->image_gallery, $hotel);
            $this->updateHotelAttributes($request->attribute_option, $hotel);
            $this->updateHotelAdvancePrices($request->price_options, $hotel);
            $this->updateHotelTags($request->tags, $hotel);
            $this->updateHotelExtraFeature($request->extra_features, $hotel);
            $this->updateHotelRooms($request->room_options, $hotel);

            Session::flash("success","Update Hotel Successfull");
        }catch(Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function updateHotelImages($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        HotelImage::where("hotel_id", $hotel->id)->delete();

        foreach($data as $value){
            $hotel->images()->create([
                'image' => $value
            ]);
        }
    }

    public function updateHotelAttributes($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        try{
            $hotel->optionsAttributes()->sync($data);
        }catch(Exception $e){
            Session::flash('error', $e->getMessage());
            return false;
        }

        return true;
    }

    public function updateHotelAdvancePrices($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        foreach($data as $key => $item){
            $advancePriceInstance = AdvancePrice::where('id', $key)->first();

            if($advancePriceInstance){
                if($item['delete'] == 1){
                    $advancePriceInstance->delete();
                }else{
                    $advancePriceInstance->fill($item);
                    $advancePriceInstance->save();
                }
            }else{
                if($item['delete'] != 1){
                    $hotel->advancePrices()->create([
                        'price' => $item['price'],
                        'price_sale' => $item['price_sale'],
                        'number_people' => $item['people']
                    ]);
                }
            }
        }
    }

    public function updateHotelTags($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        $hotel->tags()->sync($data);
    }

    public function updateHotelExtraFeature($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;

        $hotel->extraFeatures()->sync($data);
    }

    public function updateHotelRooms($data, $hotel)
    {
        if(is_null($data) || !is_array($data) || empty($data)) return false;


        foreach($data as $key => $item){
            $roomInstance = HotelRoom::where('id', $key)->first();

            if($roomInstance){
                OfferHotelRoom::where('room_id', $roomInstance->id)->delete();

                if($item['delete'] == 1){
                    $roomInstance->delete();
                }else{
                    $roomInstance->fill($item);
                    $roomInstance->save();

                    $features = $item['room_features'];
                    if(is_null($features) || !is_array($features) || empty($features)) break;
                    foreach($features as $feature_id){
                        OfferHotelRoom::create([
                            'room_id' => $roomInstance->id,
                            'feature_id' => $feature_id
                        ]);
                    }
                }
            }else{
                if($item['delete'] != 1){
                    $roomInstance = HotelRoom::create([
                        'hotel_id' => $hotel->id,
                        'room_name' => $item['room_name'],
                        'price' => $item['price'],
                        'price_sale' => $item['price_sale'],
                    ]);

                    $features = $item['room_features'];
                    if(is_null($features) || !is_array($features) || empty($features)) break;
                    foreach($features as $feature_id){
                        OfferHotelRoom::create([
                            'room_id' => $roomInstance->id,
                            'feature_id' => $feature_id
                        ]);
                    }
                }
            }
        }
    }

    public function getLocationName($location_id)
    {
        return $this->countryService->getCapitalName($location_id);
    }

    public function getCountryName($location_id)
    {
        return $this->countryService->getCountryName($location_id);
    }

    public function getLocationImage($location_id)
    {
        return $this->countryService->getImage($location_id);
    }

    public function getHotelsByLocation($locaion_id, $limit)
    {
        return Hotel::where('location_id', $locaion_id)->orderByDesc('id')->paginate($limit);
    }

    public function getFilterOptions($options, $attribute_code)
    {
        if(is_null($options) || empty($options)) return false;

        $results = [];
        $attributeInstance = $this->attributeService->getAttributeByCode($attribute_code);

        foreach( $options as $key => $value ){
            if($value->attribute_id == $attributeInstance->id){
                array_push( $results, $value );
            }
        }
        return $results;
    }

    public function getPeopleAdvancePrice($number)
    {
        switch ($number) {
            case 1:
                return 'One';
            case 2:
                return 'Two';
            case 3:
                return 'Three';
            case 4:
                return 'Four';
            case 5:
                return 'Five';
            case 6:
                return 'Six';
            case 7:
                return 'Seven';
            case 8:
                return 'Eight';
            case 9:
                return 'Nine';
            case 10:
                return 'Ten';
        }
    }

    public function getHotel($id)
    {
        return Hotel::where('id', $id)->first();
    }

    public function getPercentSale($hotel)
    {
        $price = $hotel->price;
        $price_sale = $hotel->price_sale;
        $number = (1 - $price_sale/$price)*100;

        return number_format((float)$number, 2, '.', '');
    }

    public function getRoom($id)
    {
        return HotelRoom::where('id', $id)->first();
    }

    public function getListFilter($request,$location, $limit)
    {
        $priceSort = $request->price ?? null;

        return Hotel::when($location != null, function($query) use($location){
                $query->where('location_id', $location->id);
            })
            ->when($priceSort == null, function($query){
                $query->orderByDesc('id');
            })
            ->when($priceSort != null, function($query) use($priceSort){
                $query->orderBy('price', $priceSort);
            })
            ->paginate($limit);
    }

    public function getSortType($request)
    {
        switch ($request->price) {
            case 'asc':
                return 'Price Low To High';
            case 'desc':
                return 'Price High To Low';
            default:
                return 'Default';
        }
    }
}
