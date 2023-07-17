<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::guard()->user();

        if ($user->role === 'admin') {
            $url = '/admin/dashboard';
        } elseif ($user->role === 'doctor') {
            $url = '/doctor/dashboard';
        } elseif ($user->role === 'parent') {
            $url = '/parent/dashboard';
        } elseif ($user->role === 'user') {
            $url = '/user/dashboard';
        }

        $notification = [
            'message' => 'Password Reset Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->intended($url)->with($notification);
    }
}
