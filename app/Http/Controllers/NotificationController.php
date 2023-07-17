<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function index()
    {
        // Retrieve all notifications for the authenticated user
        $userId = auth()->id();
    $notifications = DB::table('notifications')
        ->where('notifiable_type', User::class)
        ->where('notifiable_id', $userId)
        ->paginate(10);


        $notifications = Auth::user()->notifications;
        $notificationCount = $notifications->count();

        // Pass the notifications to the view
        return view('admin.notifications.index', compact('notifications' , 'notificationCount'));
    }
}
