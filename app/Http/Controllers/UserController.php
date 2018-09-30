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
use App\Models\Like;

class UserController extends Controller
{

    public function profile($id = null)
    {

      if($id == null) {

           if(Auth::check()) {
              $user = User::where('slug', Auth::user()->slug);                
            } 
            else {
              abort(404);
            }

        }
      else 

        {
          if(Auth::check()) {
        $user = User::where('slug', $id);
            } 
          else {
            abort(404);
          }

        }

        $products = Product::with(['user','categories'])->paginate(3, ['*'], 'product-page');

        $blog = Blog::with(['user','tags','comments.user'])->latest();

        $blogs = Blog::paginate(3, ['*'], 'blog-page'); 

        // paginate 2 for DEMO 
        $comments = BlogComment::with(['user','likes','unlikes'])->paginate(2, ['*'], 'comment-page'); 

        return view('user/profile', ['products' => $products, 'comments' => $comments, 'blog' => $blog, 'blogs' => $blogs]);
           
     }

}
