<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    protected function sendResetResponse(Request $request, $response)
    {
        $user = $this->guard()->user();

        if ($user->role === 'admin') {
            $url = '/admin/dashboard';
        } elseif ($user->role === 'doctor') {
            $url = '/doctor/dashboard';
        } elseif ($user->role === 'parent') {
            $url = '/parent/dashboard';
        } elseif ($user->role === 'user') {
            $url = '/user/dashboard';
        } 

        $notification = array(
            'message' => 'Password Reset Successfully',
            'alert-type' => 'success'
       );

      

        return redirect()->intended($url)->with($notification);

    }


    public function __construct()
{
    $this->middleware('guest');
}


}
