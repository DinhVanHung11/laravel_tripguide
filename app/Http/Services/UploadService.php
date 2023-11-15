<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    public function store($request)
    {
        if($request->hasFile('file')){
            try{
                $filename = $request->file('file')->getClientOriginalName();

                $path = $request->file('file')->storeAs('public/uploads/'.date('Y/m/d'), $filename);

                return str_replace('public/','/storage/',$path);
            }catch(Exception $err){
                return null;
            }
        }
    }

    public function delete($path= '')
    {
        Storage::delete(str_replace('/storage','public',$path));
    }
}
