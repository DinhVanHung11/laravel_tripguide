<?php

namespace App\Http\Controllers;

use App\Http\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function location(Request $request)
    {
        $res = $this->searchService->searchLocation($request);

        if($res == false){
            return response()->json([
                'error' => true,
                'message' => 'No results'
            ]);
        }

        return response()->json([
            'error' => false,
            'html' => $res
        ]);
    }
}
