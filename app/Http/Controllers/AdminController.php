<?php

namespace App\Http\Controllers;
use App\Mail\VerificationEmail;
use App\Mail\VaccineReminderMail;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\VaccineType;
use App\Models\Infant;
use App\Models\InfantVaccine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function AdminDashboard(){

     $users = User::where('status', 'pending')->get();

     // users 
               $newUsersCount = User::whereDate('created_at', today())->count();
               $previousDayUsersCount = User::whereDate('created_at', today()->subDay())->count();

               $userspercentageIncrease = 0;
               if ($previousDayUsersCount > 0) {
               $userspercentageIncrease = (($newUsersCount - $previousDayUsersCount) / $previousDayUsersCount) * 100;
               }

// vaccines 
          $newVaccinesCount = VaccineType::whereDate('created_at', today())->count();
        $previousDayVaccinesCount = VaccineType::whereDate('created_at', today()->subDay())->count();

        $vaccinespercentageIncrease = 0;
        if ($previousDayVaccinesCount > 0) {
            $vaccinespercentageIncrease = (($newVaccinesCount - $previousDayVaccinesCount) / $previousDayVaccinesCount) * 100;
        }

// Infants 
          $newInfantsCount = Infant::whereDate('created_at', today())->count();
        $previousDayInfantsCount = Infant::whereDate('created_at', today()->subDay())->count();

        $infantspercentageIncrease = 0;
        if ($previousDayInfantsCount > 0) {
            $infantspercentageIncrease = (($newInfantsCount - $previousDayInfantsCount) / $previousDayInfantsCount) * 100;
        }
  

        // count monthly completed vaccines 
        $monthlyCompletedVaccines = InfantVaccine::where('completed', true)
        ->where(function ($query) {
          $query->whereYear('administration_date', '<', Carbon::now()->year)
              ->orWhere(function ($query) {
                  $query->whereYear('administration_date', Carbon::now()->year)
                      ->whereMonth('administration_date', '<=', Carbon::now()->month);
              });
      })
        ->groupBy('administration_date')
        ->orderBy('administration_date')
        ->get([
            DB::raw('DATE(administration_date) as date'),
            DB::raw('COUNT(*) as count')
        ]);
        // pending 
        $monthlyPendingVaccines = InfantVaccine::where('completed', false)
        ->where(function ($query) {
          $query->whereYear('administration_date', '<', Carbon::now()->year)
              ->orWhere(function ($query) {
                  $query->whereYear('administration_date', Carbon::now()->year)
                      ->whereMonth('administration_date', '<=', Carbon::now()->month);
              });
      })
        ->groupBy('administration_date')
        ->orderBy('administration_date')
        ->get([
            DB::raw('DATE(administration_date) as date'),
            DB::raw('COUNT(*) as count')
        ]);
    
       

        $notifications = Auth::user()->notifications;
        $notificationCount = $notifications->count();
        
     
        
        
     return view('admin.index', compact('users','newUsersCount', 'userspercentageIncrease' , 'notifications', 'notificationCount',
                                        'newVaccinesCount', 'infantspercentageIncrease','vaccinespercentageIncrease', 
                                        'newInfantsCount', 'monthlyCompletedVaccines', 'monthlyPendingVaccines'));

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
     
     public function verificationUrl(User $user)
{
    $expires = time() + 60 * 60 * 24; // URL expiration time (e.g., 24 hours)
    $url = URL::temporarySignedRoute('verification.verifymine', $expires, [
     'id' => $user->id,
     'hash' => sha1($user->email),
     ]);
    
    return $url;

}



     public function sendVerificationEmail(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $verificationUrl = $this->verificationUrl($user);
     


        // Send verification email to the specific user
        Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));

        $notification = array(
          'message' => 'Verify Email sent Successfully',
          'alert-type' => 'success'
     );

    
        return back()->with($notification );
    }

    public function sendVaccineReminderEmails(Request $request)
    {
        
        $infant = Infant::findOrFail($request->infant_id);

                    $vaccines = InfantVaccine::where('vaccine_id', $request->vaccine_id)
               ->where('completed', false)
               ->whereNotNull('next_due_date')
               ->whereDate('next_due_date', '>=', now()->subDays(3))
               ->whereDate('next_due_date', '<=', now()->addDays(1))
               ->get();

               foreach ($vaccines as $vaccine) {
                    $notificationData = [
                        'infant' => $infant,
                        'vaccine' => VaccineType::findOrFail($vaccine->vaccine_id),
                    ];


                    Mail::to($infant->parent_email)
                    ->send(new VaccineReminderMail($infant, VaccineType::findOrFail($vaccine->vaccine_id)));
            }



        $notification = array(
          'message' => 'Reminder  Email sent Successfully',
          'alert-type' => 'success'
     );

    
        return back()->with($notification );
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
        return view('admin.notifications.index');
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
