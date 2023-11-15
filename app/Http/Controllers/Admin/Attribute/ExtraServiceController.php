<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Services\FeatureService;
use App\Models\ExtraService;
use Illuminate\Http\Request;

class ExtraServiceController extends Controller
{
    protected $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->featureService = $featureService;
    }

    public function index()
    {
        return view("admin.attribute.services.index", [
            'exServices' => $this->featureService->getAll()
        ]);
    }

    public function create()
    {
        return view("admin.attribute.services.add");
    }

    public function store(Request $request)
    {
        $res = $this->featureService->create($request);

        if($res){
            return redirect()->route("admin.hotel.extrafeatures.index");
        }

        return redirect()->back();
    }

    public function edit(ExtraService $extraService)
    {
        return view("admin.attribute.services.edit", [
            'exService' => $extraService
        ]);
    }

    public function update(Request $request, ExtraService $extraService)
    {
        $res = $this->featureService->update($request, $extraService);

        if($res){
            return redirect()->route("admin.hotel.extrafeatures.index");
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $res = $this->featureService->delete($request->id);

        if($res){
            return response()->json([
                'error' => false,
                'message' => 'Delete Succesfull'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => $res
        ]);
    }
}
