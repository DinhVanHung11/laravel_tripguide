<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        return view('frontend.pages.home',[
            'bodyClass' => 'home-page',
            'pageFullWidth' => true
        ]);
    }
}
