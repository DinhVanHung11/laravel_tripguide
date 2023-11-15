<?php

namespace App\Http\Services;

use App\Models\Tag;
use Illuminate\Support\Facades\Session;

class TagService
{
    public function create($request)
    {
        try{
            $data = $request->all();
            Tag::create($data);

            Session::flash("success","Create New Tag Success");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function getAll()
    {
        return Tag::all();
    }

    public function update($request, $tag)
    {
        try{
            $data = $request->all();
            $tag->fill($data);
            $tag->save();

            Session::flash("success","Update Tag Success");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        try{
            Tag::find($id)->delete();
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }
}
