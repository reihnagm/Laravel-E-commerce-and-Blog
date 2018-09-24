<?php

namespace App\Http\Controllers;

use Auth;
use Toastr;

use App\Models\User;
use App\Models\Blog;
use App\Models\Like;
use App\Models\BlogComment;
use App\Models\Notification;

// API
// use App\Http\Resources\BlogCommentResource as BlogCommentCollection;

use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    
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

    public function store(Request $request, $id)
    {

        $request->validate([
            'subject' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        $blogcomment = BlogComment::create([
            'subject' => $request->subject,
            'blog_id' => $id,
            'user_id' => Auth::user()->id
        ]);
 
        if ($blog->user->id != Auth::user()->id) 
        {
            Notification::create([
                'user_id'  => Auth::user()->id,
                'blog_id' => $id,
                'subject'  => 'ada komentar dari'.' '. Auth::user()->name,
            ]);
        }

        return json_encode(['message' => 'sentComment']);

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

      Toastr::info('Comment was updated!');

     return back();
      
    }
   
    public function destroy($id)
    {

     $blogcomment = BlogComment::findOrFail($id);
     $blogcomment->delete();

     Toastr::info('Comment was deleted!');

     return $blogcomment;
        
    }

}
