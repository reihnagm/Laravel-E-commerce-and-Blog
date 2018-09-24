<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\User;
use App\Models\Like;
use App\Models\Blog;
use App\Models\BlogComment;

use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function like($model_id, $type)
    {
        
     $results    = $this->check_type($type, $model_id);
     $type = $results['0'];
     $model  = $results['1'];

     if($model->is_liked() == null) {
          
        Like::create([
        'user_id' => auth()->user()->id,
        'likeable_id' => $model_id,
        'likeable_type' => $type
        ]);

        return json_encode(['message' => 'like']);

     }
  
    }

    public function unlike($model_id, $type)
    {
        
     $results = $this->check_type($type, $model_id);
     $type = $results['0'];
     $model  = $results['1'];

       if($model->is_liked()) {

        Like::where('user_id', Auth::user()->id)
        ->where('likeable_id', $model_id)
        ->where('likeable_type', $type)->delete();

         return json_encode(['message' => 'unlike']);

       }

       
    }
    
     public function check_type($type, $model_id)
    {

        switch($type) {
            case 1:
            $type = 'App\Models\Blog';
            $model = Blog::findOrFail($model_id);
            break;
            case 2: 
            $type = 'App\Models\BlogComment';
            $model = BlogComment::findOrFail($model_id);
            default:
            break;
        }

        return array($type, $model);

    }


}
