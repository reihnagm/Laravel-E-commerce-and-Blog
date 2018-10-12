<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\Message;
use App\Events\ChatCreated;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.index');
    }

    public function getMessages()
    {
        return Message::with('user')->take(10)->orderBy('id', 'desc')->get();
    }

    public function postMessage(Request $request)
    {
        $message = Message::create([
            'subject' => $request->subject,
            'user_id' => Auth::user()->id
        ]);

        broadcast(new ChatCreated($message))->toOthers();

        return $message;
    }
}
