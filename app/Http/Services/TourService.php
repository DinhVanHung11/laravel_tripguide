<?php

namespace App\Http\Services;

use App\Models\Country;
use App\Models\Tour;
use Illuminate\Support\Facades\Session;

class TourService
{
    public function getAll()
    {
        return Tour::all();
    }

    public function getCountry($country_id)
    {
        return Country::find($country_id);
    }

    public function create($request)
    {
        try{
            $data = $request->all();
            Tour::create($data);

            Session::flash("success","Create New Tour Successfull");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $tour)
    {
        try{
            $data = $request->all();
            $tour->fill($data);
            $tour->save();

            Session::flash("success","UpdateTour Successfull");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        return Tour::where('id', $id)->delete();
    }
}
