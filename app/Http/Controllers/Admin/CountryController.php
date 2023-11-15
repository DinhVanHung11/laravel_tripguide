<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        return view('admin.countries.index', [
            'countries' => $this->countryService->getCountries(20),
        ]);
    }

    public function store(Request $request)
    {
        $res = $this->countryService->create($request);

        return redirect()->back();
    }

    public function cities()
    {
        return view('admin.countries.cities');
    }

    public function searchAjax(Request $request)
    {
        $res = $this->countryService->searchAjax($request);

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
