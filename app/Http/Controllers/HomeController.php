<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
	
        return view('app.index', ["user"=> $request->user(), "products" => Product::with(['user', 'category'])->paginate(3, ['*'], 'product-page'), "categories" => Category::all(), "tags" => $tags = Tag::all(), "blogs" => Blog::with(['user', 'tags'])->paginate(3, ['*'], 'blog-page')]); 
	
    }

    public function blogProductSearch(Request $request)
    {

        $search_q = urlencode($request->input('search'));

        if(!empty($search_q)) {
            $products = Product::with(['user','category'])->where('name', 'like', '%'. $search_q .'%')->paginate(3, ['*'], 'product-page');
            $blogs = Blog::with(['user','tags'])->where('title', 'like', '%'. $search_q .'%')->paginate(3, ['*'], 'blog-page');

        } else {
            $products = Product::with(['user','category'])->paginate(4);
            $blogs = Blog::with(['user','tags'])->paginate(4);
        }

        return view('app.index',["user" => $request->user(), "blogs" => $blogs, "tags" => Tag::all(), "products" => $products,  "categories" => Category::all()]);

    }

    public function productFilter(Request $request, $category)
    {

      $products = Product::with(['user','category'])->whereHas('category', function($query) use ($category) {
      $query->where('name', $category);
      })->paginate(3, ['*'], 'product-page');

      return view('app.index',["user" => $request->user(), "blogs" => Blog::paginate(3, ['*'], 'blog-page'), "products" => $products, "tags" => Tag::all(), "categories" => Category::all()] );

    }

    public function blogFilter(Request $request, $tag)
    {

      $blogs = Blog::with(['user','tags'])->whereHas('tags', function($query) use ($tag) {
      $query->where('name', $tag);
      })->paginate(3, ['*'], 'blog-page');

      return view('app.index', ["user"=> $request->user(), "blogs" => $blogs, "products" => Product::paginate(3, ['*'], 'product-page'), "tags" => Tag::all(), "categories" => Category::all()]);

    }

}
