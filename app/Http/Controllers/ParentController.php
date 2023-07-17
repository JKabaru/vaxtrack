<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller

{
    
    public function ParentDashboard(){


     $notifications = Auth::user()->notifications;
        $notificationCount = $notifications->count();

        return view('parent.index',compact('notifications', 'notificationCount'));

    }

    public function ParentLogout(Request $request)
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
     
     
     public function ParentProfile()
     {
      
          $id = Auth::user()->id;
          $profileData = User::find($id);


          return view('parent.parent_profile_view', compact('profileData'));
     }


     public function ParentProfileStore(Request $request)
     {
          $id = Auth::user()->id;
          $data = User::find($id);
          $data->name = $request->name; 
          $data->email = $request->email; 
          $data->phone_number = $request->phone; 
          $data->address = $request->address;
          
          if($request->file('photo')){
               $file = $request->file('photo');
               @unlink(public_path('upload/parent_images/'.$data->photo));
               $filename = date('YmdHi').$file->getClientOriginalName(); 
               $file->move(public_path('upload/parent_images'), $filename);
               $data['photo'] = $filename;
          }  
          
          $data->save();

          $notification = array(
               'message' => 'Profile Updated Successfully',
               'alert-type' => 'success'
          );

          return redirect()->back()->with($notification);
     }


     public function ParentChangePassword(Request $request)
     {
          $id = Auth::user()->id;
          $profileData = User::find($id);

          return view('parent.parent_change_password', compact('profileData'));
     }
    
     public function ParentUpdatePassword(Request $request)
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

   
     ///notifications
     public function ViewNotifications()
    {
        // Retrieve all notifications for the authenticated user
        $userId = auth()->id();
    $notifications = DB::table('notifications')
        ->where('notifiable_type', User::class)
        ->where('notifiable_id', $userId)
        ->paginate(10);


        

        // Pass the notifications to the view
        return view('parent.notifications.index');
    }

    public function MarkAsRed($id)
    {

     if($id)
     {
          auth()->user()->unreadNotifications->where('id', $id)->MarkAsRead();
     }

     return back();


    }

    public function markAllAsRed()
    {
    auth()->user()->unreadNotifications->markAsRead();
    
    return back();
    }

}
