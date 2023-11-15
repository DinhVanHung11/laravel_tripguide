<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Services\Store\ConfigurationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigurationController extends Controller
{
    protected $storeConfigService;

    public function __construct()
    {
        $this->storeConfigService = new ConfigurationService;
    }

    public function index()
    {
        $uid = Str::random(9);
        return view('admin.store.configuartion', [
            'heading' => 'Store Configuration',
            'config' => $this->storeConfigService->getFirst(),
            'id' => $uid
        ]);
    }

    public function store(Request $request)
    {
        $res = $this->storeConfigService->save($request);

        return redirect()->back();
    }
}
