<?php

namespace App\Http\Controllers;

use Toastr;

use App\Models\Blog;
use App\Models\Emotion;
use App\Models\Notification;

use Illuminate\Http\Request;

class EmotionController extends Controller
{
    public function index($id)
    {
        $emotions = Emotion::where('blog_id', $id)->get();

        $total= count($emotions);

        $happy = 0;
        $sad = 0;
        $angry = 0;
        $amazing = 0;
        $fear = 0;
        $doubt = 0;


        foreach ($emotions as $emotion) {
            switch ($emotion['emotion_id']) {
                case 1: $happy++; break;
                case 2: $sad++; break;
                case 3: $angry++; break;
        case 4: $amazing++; break;
        case 5: $fear++; break;
        case 6: $doubt++; break;
                default: break;
            }
        }

        return json_encode([
            "total" => $total,
            "happy" => $happy,
            "sad" => $sad,
            "angry" => $angry,
      "amazing" => $amazing,
      "fear" => $fear,
      "doubt" => $doubt
        ]);
    }

    public function save($emotion_id, $blog_id)
    {
        $blog = Blog::findOrFail($blog_id);

        $emotion = Emotion::where('blog_id', $blog_id)->where('user_id', auth()->user()->id)->first();

        if (!$emotion) {
            Emotion::create([
            "emotion_id"  => $emotion_id,
            "blog_id" => $blog_id,
            "user_id" => auth()->user()->id,
        ]);

            if ($blog->user->id != auth()->user()->id) {
                Notification::create([
       'user_id' => $blog->user->id,
       'blog_id' => $blog_id,
       'subject' => auth()->user()->name.' vote your blogs'
     ]);
            }

            return json_encode([
            "message" => "vote"
        ]);
        } elseif ($emotion->emotion_id == $emotion_id) {
            Emotion::where('blog_id', $blog_id)->where('user_id', auth()->user()->id)->delete();

            return json_encode([
            "message" => "unvote"
        ]);
        } else {
            Emotion::where('blog_id', $blog_id)->where('user_id', auth()->user()->id)->
       update([
           "emotion_id" => $emotion_id
       ]);

            return json_encode([
        "message" => "changed",
          "old_emotion" => $emotion->emotion_id
      ]);
        }
    }
}
