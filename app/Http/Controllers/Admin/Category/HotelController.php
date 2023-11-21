<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Services\AttributeService;
use App\Http\Services\CountryService;
use App\Http\Services\FeatureService;
use App\Http\Services\HotelService;
use App\Http\Services\Store\LocationService;
use App\Http\Services\TagService;
use App\Models\ExtraService;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $hotelService;
    protected $attributeService;
    protected $locationService;
    protected $countryService;
    protected $tagService;
    protected $featureService;

    public function __construct(
        HotelService $hotelService,
        AttributeService $attributeService,
        LocationService $locationService,
        CountryService $countryService,
        TagService $tagService,
        FeatureService $featureService
    ){
        $this->hotelService = $hotelService;
        $this->attributeService = $attributeService;
        $this->locationService = $locationService;
        $this->countryService = $countryService;
        $this->tagService = $tagService;
        $this->featureService = $featureService;
    }

    public function index()
    {
        return view('admin.hotel.index',[
            'heading' => 'Hotel Management',
            'hotels' => $this->hotelService->getLimit()
        ]);
    }

    public function create()
    {
        return view('admin.hotel.add', [
            'heading' => 'Add New Hotel',
            'attributes' => $this->attributeService->getAll(),
            'countries' => $this->countryService->getAll(),
            'tags' => $this->tagService->getAll(),
            'extraFeatures' => $this->featureService->getAll()
        ]);
    }

    public function store(Request $request)
    {
        $res = $this->hotelService->create($request);

        if($res){
            return response()->json([
                'error' => false,
                'url' => route('admin.hotel.index')
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotel.edit', [
            'heading' => 'Edit hotel: '.$hotel->name,
            'hotel' => $hotel,
            'attributes' => $this->attributeService->getAll(),
            'countries' => $this->countryService->getAll(),
            'tags' => $this->tagService->getAll(),
            'extraFeatures' => $this->featureService->getAll()
        ]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $res = $this->hotelService->update($request, $hotel);

        if($res){
            return response()->json([
                'error' => false,
                'url' => route('admin.hotel.index')
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function advancePrice(Request $request)
    {
        return response()->json([
            'message' => '123'
        ]);
    }

    public function search(Request $request)
    {
        $url = 'hotel.html';
        $res = $this->locationService->searchWithAjax($request);

        if($res == ''){
            return response()->json([
                'message' => 'No results',
                'error' => true
            ]);
        }

        return response()->json([
            'url' => $url.$res,
            'error' => false
        ]);
    }

    public function list(Request $request)
    {
        $location = $this->countryService->getBySlug($request->location);
        $sortType = $this->hotelService->getSortType($request);

        return view('frontend.pages.list.hotel_list', [
            'location' => $location,
            'checkin' => $request->check_in ?? '',
            'checkout' => $request->check_out ?? '',
            'bodyClass' => 'category-view',
            'hiddenBgHeader' => true,
            'sortType' => $sortType,
            'hotels' => $this->hotelService->getListFilter($request,$location,6)
        ]);
    }

    public function show(Request $request, $slug, $id)
    {
        return view('frontend.pages.details', [
            'hotel' => $this->hotelService->getHotel($id),
            'bodyClass' => 'catalog-detail-view catalog-hotel',
            'hideSearchBar' => true
        ]);
    }
}
