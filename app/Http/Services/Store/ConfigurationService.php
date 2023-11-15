<?php

namespace App\Http\Services\Store;

use App\Models\StoreConfiguration;
use Exception;
use Illuminate\Support\Facades\Session;

class ConfigurationService
{
    public function getFirst()
    {
        return StoreConfiguration::where('id',1)->first();
    }

    public function save($request)
    {
        $data = $request->input();
        unset($data['_token']);

        try{
            if(!$this->getFirst()){
                StoreConfiguration::create($data);
            }else{
                $configInstance = $this->getFirst();
                $configInstance->fill($data);
                $configInstance->save();
            }

            Session::flash('success', 'Updated Store Configuration');
        }catch(Exception $error){
            Session::flash('error', $error->getMessage());
            return false;
        }

        return true;
    }
}
