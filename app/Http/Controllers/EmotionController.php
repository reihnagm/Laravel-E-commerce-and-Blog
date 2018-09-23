<?php

namespace App\Http\Controllers;

use App\Models\BlogEmotion;

use DB;
use Auth;

use App\Models\Emotion;

use Illuminate\Http\Request;

class EmotionController extends Controller
{

    public function index()
    {

      return Emotion::all();

    }
    
    public function create($id)
    {

    $emotions = BlogEmotion::where('blog_id', $id)->get();

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
          case 1: $happy++; break;
          case 2: $sad++; break;
          case 3: $angry++; break;
          case 4: $fear++; break;
          case 5: $doubt++; break;
          case 6: $amazing++; break;
          default: break;
        }
    } 

     return json_encode([
      "total" => $total, 
      "happy" => $happy,
      "sad"   => $sad,
      "angry" => $angry,
      "fear" => $fear,
      "doubt" => $doubt,
      "amazing" => $amazing,
      ]);

    }


    public function saveEmotion($emotionid, $blogid) 
    {

      $emotion = BlogEmotion::where('blog_id', $blogid)->where('user_id', Auth::user()->id)->first();

      if (!$emotion) {

       BlogEmotion::create([
       'emotion_id' => $emotionid,
       'blog_id' => $blogid,
       'user_id' => Auth::user()->id
       ]);

       return json_encode(['message' => 'success']);
      
      } else if ($emotion->emotion_id == $emotionid) {

       BlogEmotion::where('blog_id', $blogid)->where('user_id', Auth::user()->id)->delete();

       return json_encode(['message' => 'unvote']);

      } else {
      
       BlogEmotion::where('blog_id', $blogid)->where('user_id', Auth::user()->id)->update([
         'emotion_id' => $emotionid
       ]);

       return json_encode([
         'message' => 'changed',
         'old_emotion' => $emotion->emotion_id
        ]);

      }

  
   
    }

}
