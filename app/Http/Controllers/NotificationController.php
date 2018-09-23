<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{

    public function get()
    {

        $user = auth()->user();
        
        $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('user/profile', ['notifications' => $notifications, 'user' => $user]);

    }

    public function markAsRead(Request $request, $id)
    {

        $user = Auth::user();

        $notif = DB::table('notifications')->where('id', $id)->where('user_id', $user->id)->update(['seen' => 1]);
 
        return $notif;

    }

}
