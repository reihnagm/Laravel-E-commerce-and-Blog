<?php

namespace App\Http\Controllers;

use Toastr;

use App\Events\NewComment;

use App\Models\User;
use App\Models\Blog;
use App\Models\Like;
use App\Models\BlogComment;
use App\Models\Notification;

use App\Http\Resources\BlogCommentResource as BlogCommentCollection;

use Illuminate\Http\Request;

class BlogCommentController extends Controller
{

    /*-------------------------------------
    -- RETURN COLLECTION WITH RELATION USER
    ---------------------------------------*/

    // $comment ="";
    // $like = 0;
    // $unlike = 0;

    // foreach($blogComment as $comment) {
    //     $like  = $comment->likes->count();
    //     $unlike = $comment->unlikes->count();
    // }

    // return json_encode([
    //     "data" => $blogComment,
    //     "like" => $like,
    //     "unlike"=> $unlike
    // ]);


    public function index($id)
    {


     return new BlogCommentCollection(BlogComment::where('blog_id',$id)->with(['user'])->withCount(['likes', 'unlikes'])->paginate(10));


      // return view('user/profile',['blogcomments' => $blogcomments]);

    // RETURN API
    //  return new BlogCommentCollection($blogcomment);

    }


    public function store(Request $request, $id, $userId)
    {

        $request->validate([
            'subject' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        $blogcomment = BlogComment::create([
            'subject' => $request->subject,
            'blog_id' => $id,
            'user_id' => $userId
        ]);

        if ($blog->user->id != auth()->user()->id)
        {
            Notification::create([
                'user_id'  => $blog->user->id,
                'blog_id' =>  $blog->id,
                'subject'  => auth()->user()->name .' comments on your blog '.'"'.$blog->title.'"'
            ]);
        }

        broadcast(new NewComment($blogcomment))->toOthers();

        return json_encode(['message' => 'comment']);

    }

    public function update(Request $request, $id)
    {

     $blogcomment = BlogComment::findOrFail($id);

     $blogcomment->update([
      "subject" => $request->subject
     ]);

      return json_encode([
         "message" => "comment updated"
     ]);

    }

    public function destroy($id)
    {

     $blogcomment = BlogComment::findOrFail($id);
     $blogcomment->delete();

     return json_encode([
         "message" => "comment destroy"
     ]);

    }

}
