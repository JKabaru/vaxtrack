<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    
    public function DoctorDashboard(){

        return view('doctor.index');

    }

    public function DoctorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

       
            return redirect('/admin/login');
    }

   

    

    

//     public function AdminReset()
//     {
//          return view('admin.admin_reset');
//     }
     
     
     public function DoctorProfile()
     {
      
          $id = Auth::user()->id;
          $profileData = User::find($id);


          return view('doctor.doctor_profile_view', compact('profileData'));
     }


     public function DoctorProfileStore(Request $request)
     {
          $id = Auth::user()->id;
          $data = User::find($id);
          $data->name = $request->name; 
          $data->email = $request->email; 
          $data->phone_number = $request->phone; 
          $data->address = $request->address;
          
          if($request->file('photo')){
               $file = $request->file('photo');
               @unlink(public_path('upload/doctor_images/'.$data->photo));
               $filename = date('YmdHi').$file->getClientOriginalName(); 
               $file->move(public_path('upload/doctor_images'), $filename);
               $data['photo'] = $filename;
          }  
          
          $data->save();

          $notification = array(
               'message' => 'Profile Updated Successfully',
               'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);
     }


     public function DoctorChangePassword(Request $request)
     {
          $id = Auth::user()->id;
          $profileData = User::find($id);

          return view('doctor.doctor_change_password', compact('profileData'));
     }
    
     public function DoctorUpdatePassword(Request $request)
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
