<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\User;
use App\Models\Like;
use App\Models\Unlike;
use App\Models\Blog;
use App\Models\Notification;
use App\Models\BlogComment;

use Illuminate\Http\Request;

class UnlikeController extends Controller
{

    public function unlike($model_id, $type)
    {
        
     $results = $this->check_type($type, $model_id);
     $model_type  = $results['0'];
     $model = $results['1'];

    if($model->is_unliked() == null) {

       Unlike::create([
           'user_id' => auth()->user()->id,
           'unlikeable_id' => $model_id,
           'unlikeable_type' => $model_type
       ]);

        switch($type) {
            case 1: 
            Notification::create([
            'user_id'  => $model->user->id,
            'blog_id' => $model->id,
            'subject'  => Auth::user()->username. ' "Unlikes your post."'
            ]);
            break;
            case 2:
             Notification::create([
            'user_id'  => $model->user->id,
            'blog_id' => $model->blog->id,
            'subject'  => Auth::user()->username. ' "Unlikes your comment."'
            ]);
        }

      return json_encode(['message' => 'unlike']);

     }
     
    }

    public function cancel_unlike($model_id, $type)
    {
        
     $results = $this->check_type($type, $model_id);
     $model_type  = $results['0'];
     $model = $results['1'];

    if($model->is_unliked()) {

        Unlike::where('user_id', Auth::user()->id)
        ->where('unlikeable_id', $model_id)
        ->where('unlikeable_type', $model_type)->delete();

      return json_encode(['message' => 'cancel_unlike']);

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
