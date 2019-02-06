<?php

namespace App\Http\Controllers;

use Toastr;
use File;
use Storage;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use TCG\Voyager\Facades\Voyager;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


class BlogController extends Controller
{
    public function create(Request $request)
    {
        return view('blog/create', ['user' => $request->user(), 'tags' => Tag::all()]);
    }

    public function store(BlogRequest $request)
    {


        // STORING IMAGE BLOB ALTERNATIVE 1
        // if ($request->hasFile('img')) {
        //      $img = $request->file('img');
        //      $filename = time(). "-" . $img->getClientOriginalName();
        //      $image = base64_encode(file_get_contents($request->file('img')));
        //      $blog->img = $image;
        //   }

        // STORING IMAGE BLOB ALTERNATIVE 2
        // if ($request->hasFile('img')) {
        //     $file =Input::file('img');
        //     $imagedata = file_get_contents($file);
        //     $base64 = 'data:image/jpeg;base64,'. base64_encode($imagedata);
        //     $blog->img = $base64;
        // }

        $slug = str_slug($request->title, '-');

        $blog = Blog::where('slug', $slug)->first();

        if ($blog != null) {
            $slug = $slug . '-' .time();
        }

        // COPY FROM VOYAGER UPLOAD IMAGE
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;

        $file = $request->file('img');

        $path =  '/'.date('F').date('Y').'/';

        $filename = basename($file->getClientOriginalName().'-'.time(), '.'.$file->getClientOriginalExtension());

        $fullPath = 'blogs'.$path.$filename.'.'.$file->getClientOriginalExtension();

        $image = Image::make($file)->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode($file->getClientOriginalExtension(), 75);

        Storage::disk('public')->put($fullPath, (string) $image, 'public');

        $fullFilename = $fullPath;


        $blog = Blog::create([
         "title"   => $request->title,
         "img"     => $fullFilename,
         "caption" => $request->caption,
         "desc"    => $request->desc,
         "user_id" => auth()->user()->id,
         "slug"    => $slug
       ]);

        $blog->tags()->attach($request->tags);

        $blog->save();

        auth()->user()->blogs()->save($blog);

        Toastr::info('Successfully created a Blog!');

        return redirect(route('user.profile'));
    }

    public function show($id)
    {

        $blog = Blog::with(['user', 'tags:name', 'comments.user'])->where('slug', $id)->first();

        $blogs = Blog::with(['user', 'tags:name'])->paginate(3, ['*'], 'blog-page');

        $products = Product::with(['user','category:name'])->paginate(3, ['*'], 'product-page');

        $tags = Tag::all();

        if ($blog) {
            $comments = $blog->comments()->with(['user','likes','unlikes'])->paginate(6, ['*'], 'comment-page');
        } else {
            $comments = null;
        }

        return view('blog.show', ['user' => request()->user(), 'blog' => $blog, 'blogs' => $blogs, 'comments' => $comments, 'products' => $products, 'tags' => $tags]);
    
    }


    public function edit($id, Request $request)
    {
        return view('blog/edit', ['user' => $request->user(),'blog' => Blog::where('slug', $id)->first(), 'tags' => Tag::all()]);
    }

    public function update(BlogRequest $request, $id)
    {
       
        $blog = Blog::findOrFail($id);

        $blog_img = Blog::findOrFail($id)->first();

        $oldImg = public_path("storage/{$blog_img->img}");

        // REMOVED FILE EXISTS WHEN DELETE ACTION
        // AND GETTING NEW IMAGE
        if (File::exists($oldImg)) {
            unlink($oldImg);
        }

        $file = $request->file('img');

        $path =  '/'.date('F').date('Y').'/';

        $filename = basename($file->getClientOriginalName().'-'.time(), '.'.$file->getClientOriginalExtension());

        $fullPath = 'blogs'.$path.$filename.'.'.$file->getClientOriginalExtension();

        $image = Image::make($file)->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode($file->getClientOriginalExtension(), 75);

        Storage::disk('public')->put($fullPath, (string) $image, 'public');

        $fullFilename = $fullPath;

        $slug = str_slug($request->title, '-');

        $blog = Blog::where('slug', $slug)->first();

        if ($blog != null) {
            $slug = $slug . '-' .time();
        }

        $blog->update([
        "title"  => $request->title,
        "slug" => $slug,
        "img"   => $fullFilename,
        "caption" => $request->caption,
        "desc"  => $request->desc,
        "user_id" => auth()->user()->id
      ]);

        // STORING IMAGE
        // if ($request->hasFile('img')) {
        //
        //     $img = $request->file('img');
        //
        //     $filename = time(). "-" . $img->getClientOriginalName();
        //
        //     $request->img->storeAs('public/blogs/images', $filename);
        //
        //     $blog->img = $filename;
        //
        // }

        $blog->tags()->sync($request->tags);

        auth()->user()->blogs()->save($blog);

        Toastr::info('Successfully updated a Blog!');

        return redirect('/profile');

    }

    public function destroy($id)
    {

        $blog = Blog::findOrFail($id);

        $storage = public_path("storage/{$blog->img}");

        // IF NOT USE PACKAGE VOYAGER UNCOMMENT
        // $blogImg = public_path("storage/blogs/images/{$blog->img}");

        if (File::exists($storage)) {
            unlink($storage);
        }

        $blog->tags()->detach();

        $blog->delete();

        Toastr::info('Successfully deleted a Blog!');

        return back();
        
    }
}
