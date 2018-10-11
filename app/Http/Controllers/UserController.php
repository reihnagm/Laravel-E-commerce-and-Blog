<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use File;
use Storage;
use Auth;
use Toastr;
use Cart;

use App\Http\Requests\ProductRequest;
use App\Models\User;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\BlogComment;
use App\Models\BlogEmotion;
use App\Models\Emotion;
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
            $user = User::where('id', Auth::user()->id)->with(['blogs', 'products'])->firstOrFail();           
            else 
            // automatically throw 404 if not login  
            return redirect(route('app.index'));

       else 
         
            $user = User::where('slug', $id)->firstOrFail();  
            // make a conditional to throw 404   

        // paginate products perpage 3
        $products = $user->products()->with(['user:username','categories:name'])->paginate(3, ['*'], 'product-page');

        // single blog latest update 
        $blog = $user->blogs()->with(['user:username','tags:name','comments.user'])->orderBy('id', 'desc')->limit(1)->first();

        // show comments 
        $comments = $blog->comments()->with(['user:username','likes','unlikes'])->paginate(6, ['*'], 'comment-page'); 

        // paginate recents blogs perpage 3
        $blogs = $user->blogs()->paginate(3, ['*'], 'blog-page'); 

        return view('user/profile', ['user' => $user, 'comments' => $comments, 'blog' => $blog, 'blogs' => $blogs, 'products' => $products]);
    
    }

}
