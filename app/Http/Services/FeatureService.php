<?php

namespace App\Http\Services;

use App\Models\ExtraService;
use App\Models\HotelExtraService;
use Illuminate\Support\Facades\Session;

class FeatureService
{
    public function validateRequest($request)
    {
        $data = $request->all();

        return array_merge($data, [
            'calculated_people' => isset($data['calculated_people']) ? ExtraService::ISCALCULATEPEOPLE : ExtraService::NOCALCULATEPEOPLE
        ]);
    }

    public function create($request)
    {
        try{
            $data = $this->validateRequest($request);
            ExtraService::create($data);

            Session::flash('success', 'Create New Extra Feature Success');
        }catch(\Exception $e){
            Session::flash('error', $e->getMessage());
            return false;
        }

        return true;
    }

    public function getAll()
    {
        return ExtraService::all();
    }

    public function update($request, $extraService)
    {
        try{
            $data = $this->validateRequest($request);
            $extraService->fill($data);
            $extraService->save();

            Session::flash('success', 'Update Extra Feature Success');
        }catch(\Exception $e){
            Session::flash('error', $e->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        try{
            ExtraService::find($id) ? ExtraService::destroy($id) : false;

            HotelExtraService::where('service_id', $id)->delete();
        }catch(\Exception $e){
            return $e->getMessage();
        }

        return true;
    }
}
