<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use File;
use DB;
use Storage;
use Auth;
use Toastr;
use Cart;

use App\Http\Requests\ProductRequest;
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

       if($id == null) 

            if(Auth::check())
             $user = User::where('id', Auth::user()->id)->with(['blogs', 'products'])->first();           
            else 
             abort(404);
       else 
            $user = User::where('slug', $id)->first();  
           
        $blog = $user->blogs()->with(['user','tags:name','comments.user'])->orderBy('id', 'desc')->limit(1)->first();

        $blogs = $user->blogs()->paginate(3, ['*'], 'blog-page'); 

        $products = $user->products()->with(['user:username','categories:name'])->paginate(3, ['*'], 'product-page');

        if($blog) {
         $comments = $blog->comments()->with(['user','likes','unlikes'])->paginate(6, ['*'], 'comment-page');  
        }
        else {
         $comments = null;
        }
        return view('user/profile', ['user' => $user, 'blog' => $blog, 'blogs' => $blogs, 'comments' => $comments, 'products' => $products]);
    
    }

}
