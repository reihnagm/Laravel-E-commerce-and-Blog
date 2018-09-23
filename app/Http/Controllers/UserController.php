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
use App\Models\Product;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Emotion;
use App\Models\Like;

class UserController extends Controller
{

    public function profile($id = null)
    {

      if($id == null) {

           if(Auth::check()) {
              
              $user = User::with('products.categories','blogs.tags','blogs.emotions','likes')->where('slug', Auth::user()->slug)->first();  
              
            }
           else 
            {
            abort(404);
            }

        }
      else 
        {
          
        $user = User::with('products.categories', 'blogs.tags','blogs.emotions','likes')->where('slug', $id)->first();
      
        }

        $emotions = Emotion::all();
        
        $products = $user->products()->paginate(4);

        $blog = Blog::with('user','tags')->latest()->first();

        $blogs = $user->blogs()->paginate(3, ['*'], 'blog-page'); 

        $comments = Blog::with('comments.likes')->get();

        $categories = DB::table('categories')->select('name', 'id')->get();

        $tags = Tag::all();

        $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        return view('user/profile', ['user' => $user, 'comments' => $comments, 'products' => $products, 'categories' => $categories, 'tags' => $tags, 'blog' => $blog, 'emotions' => $emotions, 'blogs' => $blogs, 'notifications' => $notifications]);
           
     }

}
