<?php

namespace App\Http\Services\Store;

use App\Models\Country;
use App\Models\Hotel;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LocationService
{
    public function getAllLocations()
    {
        return Location::all();
    }

    public function getDestination($id)
    {
        $hotels = Hotel::where("location_id", $id)->get();
        return count($hotels);
    }

    public function validateDataRequest($request)
    {
        return array_merge($request->input(), [
            'is_best' => $request->is_best ? 1 : 0,
        ]);
    }

    public function create($request)
    {
        try{
            $data = $this->validateDataRequest($request);
            Location::create($data);

            Session::flash("success","Create New Location Successfull");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $location)
    {
        try{
            $data = $this->validateDataRequest($request);
            $location->fill($data);
            $location->save();

            Session::flash("success","Update Location Successfull");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function getByAjax($request)
    {
        if($request->ajax()){
            $html = '';
            $results  = DB::table('locations')->where('name', 'LIKE', '%'.$request->value.'%')->get();

            if($results->count() > 0){
                $html = view('frontend.search.location-result', ['results' => $results])->render();
                return $html;
            }

            return false;
        }

        return false;
    }

    public function search($request)
    {
        return Location::find($request->location);
    }

    public function getBySlug($slug)
    {
        $locations = $this->getAllLocations();
        foreach ($locations as $location) {
            if(Str::slug($location->name) == $slug){
                return $location;
            }
        }
    }

    /**
     *
     * @return $url
     */
    public function searchWithAjax($request)
    {
        $url = '';
        $params = $request->all();
        unset($params['_token']);

        if($params['location']){
            $location = Country::find($params['location']);
            $url .= '?location='.Str::slug($location->name);
            unset($params['location']);

            if(count($params) > 0) {
                foreach($params as $key => $value) {
                    if(!is_null($value)){
                        $url .= '&'.$key.'='.$value;
                    }
                }
            }
        }

        return $url;
    }

    public function checkBestPlace($best)
    {
        return $best == Location::BEST_PLACE ? true : false;
    }
}
