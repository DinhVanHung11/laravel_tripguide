<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Services\TagService;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        return view("admin.attribute.tag.index",[
            'heading' => 'Tags Management',
            'tags' => $this->tagService->getAll()
        ]);
    }

    public function create()
    {
        return view("admin.attribute.tag.add");
    }

    public function store(Request $request)
    {
        $res = $this->tagService->create($request);

        if($res){
            return redirect()->route('admin.hotel.tags.index');
        }

        return redirect()->back();
    }

    public function edit(Tag $tag)
    {
        return view('admin.attribute.tag.edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $res = $this->tagService->update($request, $tag);

        if($res){
            return redirect()->route('admin.hotel.tags.index');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $res = $this->tagService->delete($request->id);

        if($res){
            return response()->json([
                'error' => false,
                'message'=> 'Delete Tag Success'
            ]);
        }

        return response()->json([
            'error' => true,
            'message'=> 'Delete Tag Failed'
        ]);
    }
}
