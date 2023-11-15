<?php

namespace App\Http\Services;

use App\Models\Country;
use App\Models\CountryCapital;
use App\Models\CountryFlag;
use App\Models\CountryLanguage;
use App\Models\CountryMap;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CountryService
{
    public function getAll()
    {
        return Country::all();
    }

    public function create($request)
    {
        foreach ($request->countries as $key => $item) {
            $country = Country::create($item);

            $this->insertCapitals($item['capitals'], $country->id);
            $this->insertFlags($item['flags'], $country->id);
            $this->insertMaps($item['maps'], $country->id);
            $this->insertLanguages($item['languages'], $country->id);
        }

        return true;
    }

    public function insertCapitals($data, $country_id)
    {
        if(!isset($data) || !is_array($data) || is_null($data)) return false;

        foreach($data as $key => $value){
            CountryCapital::create([
                'country_id' => $country_id,
                'captial_name' => $value
            ]);
        }
    }

    public function insertFlags($data, $country_id)
    {
        if(!isset($data) || is_null($data)) return false;

        CountryFlag::create([
            'country_id' => $country_id,
            'flag_png' => $data['png'] ?  $data['png'] : '',
            'flag_svg' => $data['svg'] ?  $data['svg'] : '',
        ]);
    }

    public function insertMaps($data, $country_id)
    {
        if(!isset($data) || is_null($data)) return false;

        CountryMap::create([
            'country_id' => $country_id,
            'google_map' => $data['googleMaps'] ?  $data['googleMaps'] : '',
            'open_street_map' => $data['openStreetMaps'] ?  $data['openStreetMaps'] : '',
        ]);
    }

    public function insertLanguages($data, $country_id)
    {
        if(!isset($data) || !is_array($data) || is_null($data)) return false;

        foreach($data as $key => $value){
            CountryLanguage::create([
                'country_id' => $country_id,
                'language_label' => $key,
                'language_value' => $value,
            ]);
        }
    }

    public function getCountries($limit)
    {
        return Country::paginate($limit);
    }

    public function getCapitalName($country_id)
    {
        $capital = CountryCapital::where('country_id', $country_id)->first();

        if($capital) return $capital->captial_name;

        return '';
    }

    public function getLanguage($country_id)
    {
        $language = CountryLanguage::where('country_id', $country_id)->first();

        if($language) return $language->language_value;

        return '';
    }

    public function getFlag($country_id)
    {
        $flag = CountryFlag::where('country_id', $country_id)->first();

        if($flag->flag_svg) return $flag->flag_svg;
        if($flag->flag_png) return $flag->flag_png;

        return '';
    }

    public function getMap($country_id)
    {
        $map = CountryMap::where('country_id', $country_id)->first();

        if($map->google_map) return $map->google_map;
        if($map->open_street_map) return $map->open_street_map;

        return '';
    }

    public function searchAjax($request)
    {
        if($request->ajax()){
            $html = '';
            $results  = DB::table('countries')->where('name', 'LIKE', '%'.$request->value.'%')->get();

            if($results->count() > 0){
                $html = view('admin.countries.search-result', ['results' => $results])->render();
                return $html;
            }

            return false;
        }

        return false;
    }

    public function getBestPlaces($limit)
    {
        return Country::where('is_best', 1)->orderBy('name','DESC')->limit($limit)->get();
    }

    public function getDestination($id)
    {
        $hotels = Hotel::where("location_id", $id)->get();
        return count($hotels);
    }

    public function getBySlug($slug)
    {
        $locations = Country::all();
        foreach ($locations as $location) {
            if(Str::slug($location->name) == $slug){
                return $location;
            }
        }
    }

    public function getCountry($id)
    {
        return Country::where("id", $id)->first();
    }

    public function getCountryName($id)
    {
        return Country::where("id", $id)->first()->name;
    }

    public function getImage($id)
    {
        $country = $this->getCountry($id);
        return $country->image;
    }

    public function getCountryMultipleId($ids)
    {
        $results = [];

        foreach ($ids as $id) {
            $country = Country::where("id", $id)->first();
            array_push($results, $country);
        }

        return $results;
    }
}
