<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;

class SearchService
{
    public function searchLocation($request)
    {
        if($request->ajax()){
            $html = '';
            $results  = DB::table('locations')->where('name', 'LIKE', '%'.$request->value.'%')->get();

            if($results->count() > 0){
                $html = view('frontend.search.result', ['results' => $results])->render();
                return $html;
            }

            return false;
        }

        return false;
    }
}
