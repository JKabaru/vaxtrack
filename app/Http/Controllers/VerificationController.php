<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verificationVerify(EmailVerificationRequest $request)
{
    // here is where we are updating the status plus the email date

    $request->fulfill();

    // Update the status field
    $request->user()->update(['status' => 'active']);
    event(new Verified($request->user()));


    $user = Auth::user();

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






    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/home');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    /**
     * Generate the verification URL for the given user.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    public function verificationUrl(User $user)
    {
        return route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]);
    }
}
