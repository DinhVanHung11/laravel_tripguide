<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAjaxController extends Controller
{
    public function checkLogin()
    {
        dd(auth()->user());
        return response()->json([
            'error' => auth()->check() ? true : false,
        ]);
    }
}
