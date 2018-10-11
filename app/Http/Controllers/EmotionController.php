<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use App\Models\Blog;
use App\Models\Emotion;

use Illuminate\Http\Request;

class EmotionController extends Controller
{

    public function index($blogid)
    {

       $emotions = Emotion::where('blog_id', $blogid)->get();
       
       $total = count($emotions);
       $happy = 0;
       $sad = 0;
       $angry = 0;
       $fear = 0;
       $doubt = 0;
       $amazing = 0;
       
       foreach($emotions as $emotion) 
      {
        switch ($emotion->emotion_id)
          {
            case 0: $happy++; break;
            case 1: $sad++; break;
            case 2: $angry++; break;
            case 3: $amazing++; break;
            case 4: $fear++; break;
            case 5: $doubt++; break;
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


    public function saveEmotion($emotionid, $blogid) 
    {

      $emotions = Emotion::where('blog_id', $blogid)->where('user_id', Auth::user()->id)->first();

      if (!$emotions) {

       Emotion::create([
        'user_id' => Auth::user()->id,
        'blog_id' => $blogid,
        'emotion_id' => $emotionid
       ]);

       return json_encode(['message' => 'success']);
      
      } else if ($emotions->emotion_id == $emotionid) {

       Emotion::where('blog_id', $blogid)->where('user_id', Auth::user()->id)->delete();

       return json_encode(['message' => 'unvote']);

      } else {
      
        Emotion::where('blog_id', $blogid)->where('user_id', Auth::user()->id)->update([
          'emotion_id' => $emotionid
        ]);

       return json_encode([
         'message' => 'changed',
         'old_emotion' => $emotions->emotion_id
        ]);

      }

    }

}
