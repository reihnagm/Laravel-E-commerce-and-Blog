<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{

    public function index() 
    {

        // grab all data user notifications // paginate 3 fore demo
        $notifications = auth()->user()->notifications()->with('blog')->orderBy('id', 'desc')->paginate(3, ['*'], 'notification-page');

        return view('notifications/index', ['notifications' => $notifications, 'user' => auth()->user()]);

    }

  public function mark_As_Read(Request $request, $id)
    {

        Notification::findOrFail($id)->where('id', $id)->where('user_id', Auth::user()->id)->update([
            'seen' => 1
        ]);
 
        return json_encode(['message' => 'notification readed']);

    }

}
