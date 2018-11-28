<?php

namespace App\Http\Controllers;

use App\Models\Emotion;

use Illuminate\Http\Request;

class EmotionController extends Controller
{
    public function index($id)
    {
		$emotions = Emotion::where('blog_id', $id)->get(); 
		
		$total= count($emotions);

		$happy = 0; $sad = 0; $angry = 0;

		foreach($emotions as $emotion) {
			switch ($emotion['emotion_id']) {
				case 1: $happy++; break;
				case 2: $sad++; break;
				case 3: $angry++; break;
				default: break;
			}
		}

		return json_encode([
			"total" => $total,
			"happy" => $happy,
			"sad" => $sad,
			"angry" => $angry
		]);

	}


    public function save($emotion_id, $blog_id)
    {

		$emotion = Emotion::where('blog_id', $blog_id)->where('user_id', auth()->user()->id)->first();

		if(!$emotion) {
		Emotion::create([
			"emotion_id"  => $emotion_id,
			"blog_id" => $blog_id,
			"user_id" => auth()->user()->id, 
		]); 
		 return json_encode([
			"message" => "vote"
		]);
		
	    } elseif($emotion->emotion_id == $emotion_id) {
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
