<?php

namespace App\Http\Controllers;

use Toastr;
use DB;
use Auth;
use File;
use Storage;

use App\Mail\BlogPublished;

use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource as BlogCollection;

use App\Models\User;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
  
    public function index(Request $request)
    {

        // API
        // $blog = Blog::with('user','tags','comments.user')->latest()->first();
    
        // API
        // return new BlogCollection($blog);

    }

    public function getRecentsBlog()
    {

        // API
        // $blogs = Blog::latest()->take(3)->simplePaginate(3);

        // API
        // return new BlogCollection($blogs);

    }

       public function getTags()
    {

        $tags = Tag::all();
       
        return $tags;

    }

    public function create()
    {

        $user = User::findOrFail(auth()->user()->id);

        $tags = Tag::all();

        return view('blog/create',['tags' => $tags,'user' => $user]);

    }

    public function store(BlogRequest $request)
    {

        $slug = str_slug($request->title, '-');

        $blog = Blog::where('slug', $slug)->first();

        if ($blog != null) {
            $slug = $slug . '-' .time();
        }


        $blog = Blog::create([
         "title"  => $request->title,
         "img"    => str_replace('data:image/png;base64,', '', $request->img),
         "caption" => $request->caption,
         "desc"   => $request->desc,
         "user_id" => Auth::user()->id,
          "slug"    => $slug
       ]);
       
        if ($request->hasFile('img')) {

            $img = $request->file('img');

            $filename = time(). "-" . $img->getClientOriginalName();

            $request->img->storeAs('public/blogs/images', $filename);

            $blog->img = $filename;

        }

        // Mail::to('reihanagam7@gmail.com')->send(new BlogPublished());

        $blog->tags()->attach($request->tags);

        auth()->user()->blogs()->save($blog);

        Toastr::info('Blog has been added!');

        $blog->save();

        return redirect(route('user.profile'));

    }

     public function show($id)
    {

     $user = User::firstOrFail();
      
     $blog = Blog::with(['user', 'tags:name', 'comments.user'])->where('slug', $id)->first();

     $blogs = Blog::paginate(3, ['*'], 'blog-page');
     
     $comments = $blog->comments()->with(['user','likes','unlikes'])->paginate(6, ['*'], 'comment-page');     
    
     $products = Product::with(['user:username','categories:name'])->paginate(3, ['*'], 'product-page');

     $categories = DB::table('categories')->select('name', 'id')->get();
 
     $tags = DB::table('tags')->select('name', 'id')->get();
 
     return view('blog/show', ['user' => $user, 'blog' => $blog, 'blogs' => $blogs, 'comments' => $comments, 'products' => $products, 'categories' => $categories, 'tags' => $tags]);

    }
    

    public function edit($id)
    {

     $user = User::first();

     $tags = Tag::all();

     $blog = Blog::where('slug', $id)->first();

     return view('blog/edit',  ['user' => $user,'blog' => $blog, 'tags' => $tags]);
        
    }

    public function update(Request $request, $id)
    {
    
      $blog = Blog::findOrFail($id);
      
      $blog->update([
        "title"  => $request->title,
        "slug" => str_slug($request->title, '-'),
        "img"   => str_replace('data:image/png;base64,', '', $request->img),
        "caption" => $request->caption,
        "desc"  => $request->desc,
        "user_id" => auth()->user()->id
      ]);

      if ($request->hasFile('img')) {

          $img = $request->file('img');

          $filename = time(). "-" . $img->getClientOriginalName();

          $request->img->storeAs('public/blogs/images', $filename);

          $blog->img = $filename;

      }
   

      $blog->tags()->sync($request->tags);

      auth()->user()->blogs()->save($blog);

      Toastr::info('Blog has been updated!');

      return redirect(route('user.profile'));
        
    }

    public function destroy($id)
    {

       $blog = Blog::findOrFail($id);

        $blogImg = public_path("storage/blogs/images/{$blog->img}");

        if (File::exists($blogImg)) {

            unlink($blogImg);

        }
   
        $blog->tags()->detach();

        $blog->delete();

        Toastr::info('Blog has been deleted!');

        return back();

    }

    
}
