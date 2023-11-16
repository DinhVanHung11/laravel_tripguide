<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredAdminController extends Controller
{
    protected $authenticatedSessionController;

    public function __construct()
    {
        $this->authenticatedSessionController = new AuthenticatedSessionController;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required'
        ]);

        $admin = Admin::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);


        return redirect()->route('admin.login')->with('success', 'You registed successfully. Please login to admin page!');
    }
}
