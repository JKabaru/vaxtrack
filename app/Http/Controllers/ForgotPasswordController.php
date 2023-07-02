<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetEmail(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            $token = Str::random(60);

            $user->update(['password_reset_token' => $token]);

            Mail::send('auth.passwordReset', ['token' => $token], function ($message) use ($email) {
                $message->to($email);
            });

            return back()->with('success', 'We have sent you an email with instructions on how to reset your password.');
        } else {
            return back()->with('error', 'We could not find a user with that email address.');
        }
    }
}