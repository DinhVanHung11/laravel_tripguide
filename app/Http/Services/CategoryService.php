<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    public function validateData($request)
    {
        $data = $request->input();

        unset($data["_token"]);

        return array_merge($data, [
            'status' => $request->active ? 1 : 0
        ]);
    }

    public function create($request)
    {
        try{
            $data = $this->validateData($request);

            Category::create($data);

            Session::flash("success","Create New Category Success");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $category)
    {
        try{
            $data = $this->validateData($request);

            $category->fill($data);
            $category->save();

            Session::flash("success","Update New Category Success");
        }catch(\Exception $e){
            Session::flash("error", $e->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }

    public function getParents()
    {
        return Category::where('parent_id', 0)->get();
    }

    public function getActives()
    {
        return Category::where('status', Category::ACTIVE)->get();
    }

    public function getAll()
    {
        return Category::all();
    }

    public function getCategoryById($id)
    {
        return Category::where('id', $id)->first();
    }

    public function getCategoryByName($name)
    {
        $categories = $this->getAll();

        foreach($categories as $category){
            if(strtolower($category->name) == strtolower($name)){
                return $category;
            }
        }

        return null;
    }
}
