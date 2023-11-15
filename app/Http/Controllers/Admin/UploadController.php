<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct()
    {
        $this->uploadService = new UploadService;
    }

    public function store(Request $request)
    {
        $url =$this->uploadService->store($request);
        $uid = Str::random(9);

        $html = view('admin.imageupload', ['url' => $url, 'id' => $uid])->render();

        if($url){
            return response()->json([
                'error' => false,
                'html' => $html,
                'id' => $uid,
                'url'=> $url
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Upload file failed'
        ]);
    }

    public function delete(Request $request)
    {
        $this->uploadService->delete($request->input('path'));

        return response()->json([
            'error' => false,
            'message' => 'Deleted Image'
        ]);
    }
}
