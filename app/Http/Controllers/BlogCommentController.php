<?php

namespace App\Http\Controllers;

use Auth;
use Toastr;

use App\Models\User;
use App\Models\Blog;
use App\Models\Like;
use App\Models\BlogComment;
use App\Models\Notification;

use App\Http\Resources\BlogCommentResource as BlogCommentCollection;

use Illuminate\Http\Request;

class BlogCommentController extends Controller
{

    public function index_api() {

        /*-------------------------------------
        -- RETURN COLLECTION WITH RELATION USER
        ---------------------------------------*/ 
       
        // $comment ="";
        // $like = 0;
        // $unlike = 0;
        
         return new BlogCommentCollection(BlogComment::with(['user'])->withCount(['likes', 'unlikes'])->paginate(10));

        // foreach($blogComment as $comment) {
        //     $like  = $comment->likes->count();
        //     $unlike = $comment->unlikes->count();
        // } 
        
        // return json_encode([
        //     "data" => $blogComment,
        //     "like" => $like,
        //     "unlike"=> $unlike
        // ]);

    }
    
    public function index()
    {

     
      $blogcomments = BlogComment::with('user','blog','likes','unlikes')->simplePaginate(7);

      return view('user/profile',['blogcomments' => $blogcomments]);

    // RETURN API 
    //  return new BlogCommentCollection($blogcomment);
   
    }
    
    public function create()
    {
         
    }

    public function store(Request $request, $id, $userId)
    {

        $request->validate([
            'subject' => 'required',
        ]);

        // $blog = Blog::findOrFail($id);

        $blogcomment = BlogComment::create([
            'subject' => $request->subject,
            'blog_id' => $id,
            'user_id' => $userId
        ]);
 
        // if ($blog->user->id != Auth::user()->id) 
        // {
        //     Notification::create([
        //         'user_id'  => Auth::user()->id,
        //         'blog_id' => $id,
        //         'subject'  => 'ada komentar dari'.' '. Auth::user()->name,
        //     ]);
        // }

        return back();
        // return json_encode(['message' => 'sentComment']);

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
       
    }
 
    public function update(Request $request, $id)
    {

     $blogcomment = BlogComment::findOrFail($id);

     $blogcomment->update([
      "subject" => $request->subject
     ]);

     // Toastr::info('Comment was updated!');when use api is not work

      return json_encode([
         "info" => "updated"
     ]);
      
    }
   
    public function destroy($id)
    {

     $blogcomment = BlogComment::findOrFail($id);// $request->input('comment_id')
     $blogcomment->delete();

    //  Toastr::info('Comment was deleted!'); when use api is not work

     return json_encode([
         "info" => "deleted"
     ]);
        
    }

}
