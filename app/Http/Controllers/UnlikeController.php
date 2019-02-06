<?php

namespace App\Http\Controllers;

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

     $results = $this->checkType($type, $model_id);
     $model_type  = $results['0']; // APP/MODELS/?
     $model = $results['1']; // MODEL::FINDORFAIL(ID?)

      if($model->isUnliked() == null) {

         Unlike::create([
             'user_id' => auth()->user()->id,
             'unlikeable_id' => $model_id,
             'unlikeable_type' => $model_type
         ]);

          switch($type) {
          // NOTIFICATION UNLIKE FOR BLOG   
          // IF YOU WANT BLOG HAVE A UNLIKE NOTIFICATION FEATURE, UNCOMMENT THIS
          // case 1:
          // Notification::create([
          // 'user_id'  => $model->user->id,
          // 'blog_id' => $model->id,
          // 'subject'  => Auth::user()->username. ' "Unlikes your blog."'
          // ]);
          // break;

          // NOTIFICATION UNLIKE FOR BLOG COMMENT  
            case 2:
          if($model->user->id != auth()->user()->id) {
            Notification::create([
            'user_id'  => $model->user->id,
            'blog_id' => $model->blog->id,
            'comment_id' => $model->id,
            'subject' => auth()->user()->name.' Unlikes your comment '.'"'. $model->subject .'"'
            ]);
          }
            break;

          }

        return json_encode(['message' => 'unlike']);

       }

    }

    public function cancelUnlike($model_id, $type)
    {

     $results = $this->checkType($type, $model_id);
     $model_type  = $results['0'];
     $model = $results['1'];

    if($model->isUnliked()) {

        Unlike::where('user_id', auth()->user()->id)
        ->where('unlikeable_id', $model_id)
        ->where('unlikeable_type', $model_type)->delete();

        Notification::where('user_id', $model->user->id)->where('blog_id' , $model->blog->id)->where('comment_id', $model->id)->delete();

        return json_encode(['message' => 'cancel unlike']);

     }

    }

     public function checkType($type, $model_id)
    {

        switch($type) {
            case 1:
            $type = 'App\Models\Blog'; // MODEL_TYPE
            $model = Blog::findOrFail($model_id); // MODEL_ID
            break;
            case 2:
            $type = 'App\Models\BlogComment'; // MODEL_TYPE
            $model = BlogComment::findOrFail($model_id); // MODEL_ID
            default:
            break;
        }

        return array($type, $model);

    }

}
