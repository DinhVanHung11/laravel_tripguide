<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
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
        return view('admin.users.index', [
            'heading' => 'Users Management',
            'users' => $this->userService->getUsers()
        ]);
    }

    public function online()
    {
        return view('admin.users.online', [
            'heading' => 'Users Now Online',
            'users' => $this->userService->getUsersOnline()
        ]);
    }
}
