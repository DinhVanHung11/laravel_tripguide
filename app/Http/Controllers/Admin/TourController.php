<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\TourService;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }

    public function index()
    {
        return view('admin.hotel.tour.index', [
            'tours' => $this->tourService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.hotel.tour.add', [
            'heading' => 'Add New Tour'
        ]);
    }

    public function store(Request $request)
    {
        $res = $this->tourService->create($request);

        if($res){
            return redirect()->route('admin.hotel.tours.index');
        }

        return redirect()->back();
    }

    public function edit(Tour $tour)
    {
        return view('admin.hotel.tour.edit', [
            'heading' => 'Edit Tour: '.$tour->tour_name,
            'country' => $this->tourService->getCountry($tour->country_id),
            'tour' => $tour
        ]);
    }

    public function update(Request $request, Tour $tour)
    {
        $res = $this->tourService->update($request, $tour);

        if($res){
            return redirect()->route('admin.hotel.tours.index');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $res = $this->tourService->delete($request->id);

        if($res){
            return response()->json([
                'error' => false,
                'message' => 'Delete Tour Successfull'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Delete Tour Failed'
        ]);
    }
}
