<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    //

    public function verifyEmail1(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            // Check if the hash matches the email
            $hash = sha1($user->email);
            if ($hash == $request->hash) {
                if (!$user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
                    event(new Verified($user));
                }

                // Update the user's status to "active"
                $user->status = 'active';
                $user->save();

                // Log in the user or redirect them to the appropriate dashboard based on their role
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
                    'message' => 'Thank you for verifying your account',
                    'alert-type' => 'success'
               );
        
              
        
                return redirect()->intended($url)->with($notification);




            }
        }
        $notification = array(
            'message' => 'Thank you for verifying your account',
            'alert-type' => 'success'
       );
        return redirect('/')->with($notification); // Redirect to a default location if verification fails
    }




   

}


