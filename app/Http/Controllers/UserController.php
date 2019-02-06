<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use File;
use Storage;
use Toastr;
use Cart;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use App\Http\Requests\ProductRequest;

use TCG\Voyager\Facades\Voyager;

use App\Models\User;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\BlogComment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Like;

class UserController extends Controller
{
    public function profile($id = null)
    {
     
        if ($id == null) {
            if (auth()->check()) {
                $user = User::where('slug', auth()->user()->slug)->with(['blogs.user', 'products.user'])->firstOrFail();
            }
        } else {
            $user = User::where('slug', $id)->first();
        }

        $blog = $user->blogs()->with(['user','tags','comments.user'])->latest()->limit(1)->first();

        $blogs = $user->blogs()->with(['user','tags','comments.user'])->paginate(3, ['*'], 'blog-page');

        $products = $user->products()->with(['user','category'])->paginate(3, ['*'], 'product-page');

        if ($blog) {
            $comments = $blog->comments()->with(['user','likes','unlikes'])->paginate(6, ['*'], 'comment-page');
        } else {
            $comments = null;
        }

        return view('user/profile', ['user' => $user, 'blog' => $blog, 'blogs' => $blogs, 'comments' => $comments, 'products' => $products]);
    
    }

    public function changeAvatar(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $path =  '/'.date('F').date('Y').'/';

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');

            $filename = time(). "-" . $avatar->getClientOriginalName();

            $request->avatar->storeAs('public/users/'.$path, $filename);

            $user->avatar = $filename;

        }

        $user->update(["avatar" => $request->avatar]);

        return json_encode([
            "message" => "success"
        ]);

    }


}
