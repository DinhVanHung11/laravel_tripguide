<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Services\AttributeService;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    protected $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index()
    {
        return view('admin.attribute.index', [
            'heading' => 'Hotel Attributes',
            'attributes' => $this->attributeService->getAll(),
        ]);
    }

    public function create()
    {
        return view('admin.attribute.add', [

        ]);
    }

    public function store(Request $request)
    {
        $res = $this->attributeService->create($request);

        if($res){
            return redirect()->route('admin.store.attribute');
        }

        return redirect()->back();
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attribute.edit', [
            'attribute' => $attribute
        ]);
    }

    public function update(Request $request, Attribute $attribute)
    {
        $res = $this->attributeService->update($request, $attribute);

        if($res){
            return redirect()->route('admin.store.attribute');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $res = $this->attributeService->delete( $id);

        if($res){
            return response()->json([
                'error' => false,
                'message' => 'Delete Category Successfull'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Delete Category Failed'
        ]);
    }
}
