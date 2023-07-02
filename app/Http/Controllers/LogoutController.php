<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        Auth::logout();
       

        // Reload the page to the login
        return redirect('/login')->with('message', 'You must be logged in to access the page');          
    }
}
