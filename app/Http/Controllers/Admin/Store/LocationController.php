<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Services\Store\LocationService;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        return view("admin.store.location.index", [
            'heading' => 'Management Location',
            'locations' => $this->locationService->getAllLocations()
        ]);
    }

    public function create()
    {
        return view("admin.store.location.add", [
            'heading' => 'Add New Location'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $res = $this->locationService->create($request);

        if($res){
            return redirect()->route('admin.locations');
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Location $location)
    {
        return view('admin.store.location.edit', [
            'heading' => 'Edit location: '.$location->name,
            'location' => $location
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, Location $location)
    {
        $res = $this->locationService->update($request, $location);

        if($res){
            return redirect()->route('admin.locations');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }

    public function getAllByAjax(Request $request)
    {
        $res = $this->locationService->getByAjax($request);

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
