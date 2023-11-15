<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = auth()->user();

        return view('frontend.pages.account.index',[
            'user' => $user,
            'userHelper' => $this->userService,
            'hideSearchBar' => true
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->userService->update($request, $user);

        return redirect()->back();
    }
}
