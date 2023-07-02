<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');

    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

       
            return redirect('/admin/login');
    }

    public function AdminLogin(Request $request)
    {
         return view('admin.admin_login');
    }

    public function AdminRegister(Request $request)
    {
         return view('admin.admin_register');
    }

    public function AdminEmail(Request $request)
    {
         return view('admin.admin_email');
    }

//     public function AdminReset()
//     {
//          return view('admin.admin_reset');
//     }
     
     public function AdminReset($token)
     {
      
          return view('admin.admin_reset', ['token' => $token]);
     }

     public function AdminProfile()
     {
      
          $id = Auth::user()->id;
          $profileData = User::find($id);


          return view('admin.admin_profile_view', compact('profileData'));
     }


     public function AdminProfileStore(Request $request)
     {
          $id = Auth::user()->id;
          $data = User::find($id);
          $data->name = $request->name; 
          $data->email = $request->email; 
          $data->phone_number = $request->phone; 
          $data->address = $request->address;
          
          if($request->file('photo')){
               $file = $request->file('photo');
               @unlink(public_path('upload/admin_images/'.$data->photo));
               $filename = date('YmdHi').$file->getClientOriginalName(); 
               $file->move(public_path('upload/admin_images'), $filename);
               $data['photo'] = $filename;
          }  
          
          $data->save();

          $notification = array(
               'message' => 'Profile Updated Successfully',
               'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);
     }


     public function AdminChangePassword(Request $request)
     {
          $id = Auth::user()->id;
          $profileData = User::find($id);

          return view('admin.admin_change_password', compact('profileData'));
     }
    
     public function AdminUpdatePassword(Request $request)
     {

          $request -> validate([
               'old_password' => 'required',
               'new_password' => 'required|confirmed'
          ]);

          // Match the old password 
          if(!Hash::check($request->old_password, auth::user()->password))
          {
               $notification = array(
                    'message' => 'Old Password Does not match',
                    'alert-type' => 'error'
               );

               return back()->with($notification);

          }

          // Update the New Password
          User::whereId(auth()->user()->id)->update([
               'password' => Hash::make($request->new_password)

          ]);


          $notification = array(
               'message' => 'Password Changed Successfully',
               'alert-type' => 'success'
          );

          return back()->with($notification);

     }
}
