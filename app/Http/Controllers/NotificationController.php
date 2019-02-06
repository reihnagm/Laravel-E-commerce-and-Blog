<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{

    public function index()
    {

        $notifications = auth()->user()->notifications()->with('blog')->orderBy('id', 'desc')->paginate(3, ['*'], 'notification-page');

        return view('notifications/index', ['notifications' => $notifications, 'user' => auth()->user()]);

    }

    public function markAsRead(Request $request, $id)
    {

        Notification::findOrFail($id)->where('id', $id)
        ->where('user_id', auth()->user()->id)
        ->update([
            'seen' => 1
        ]);

        return json_encode(['message' => 'notification has been read']);

    }

}
