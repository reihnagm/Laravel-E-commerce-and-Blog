<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\User;
use App\Models\Blog;
use App\Models\Like;
use App\Models\BlogComment;
use App\Models\Notification;

use App\Http\Resources\BlogCommentResource as BlogCommentCollection;

use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    
    public function index()
    {

     $blogcomment = BlogComment::with('user','blog','likes','unlikes')->simplePaginate(7);

     return new BlogCommentCollection($blogcomment);
   
    }
    
    public function create()
    {
         
    }

    public function store(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);

     if(Auth::check()){ 
        $blogcomment = BlogComment::create([
            'subject' => $request->subject,
            'blog_id' => $id,
            'user_id' => Auth::user()->id
        ]);
      }
            

        if ($blog->user->id != $request->user_id) 
        {
            Notification::create([
                'user_id'  => $blog->user->id,
                'blog_id' => $id,
                'subject'  => 'ada komentar dari'.' '. Auth::user()->name,
            ]);
        }

        return json_encode(['message' => 'success']);

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

      return json_encode(['message' => 'success']);
      
    }
   
    public function destroy($id)
    {

    $blogcomment = BlogComment::findOrFail($id);
    $blogcomment->delete();

     return $blogcomment;
        
    }

}
