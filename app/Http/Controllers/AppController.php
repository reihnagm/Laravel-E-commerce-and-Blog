<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{

    public function index()
    {

        $blogs = Blog::with('tags','user')->orderBy('id', 'desc')->paginate(4, ['*'], 'blog-page');
        $products = Product::with('categories','user')->orderBy('id', 'desc')->paginate(4, ['*'], 'product-page');

        $categories = Category::all();
        $tags = Tag::all();

        return view('app/index' ,['blogs' => $blogs, 'products' => $products, 'categories' => $categories, 'tags' => $tags]);

    }

     public function blogProductSearch(Request $request) {

         $search_q = urlencode($request->input('search'));

         $tags = Tag::all();

         $categories = Category::all();

        if (!empty($search_q)) {
            $blogs    = Blog::with('user','tags')->where('title', 'like', '%'.$search_q.'%')->paginate(4, ['*'], 'blog-page');
            $products = Product::with('user','categories')->where('name', 'like', '%'.$search_q.'%')->paginate(4, ['*'], 'product-page');
        } else {
            $blogs = Blog::with('user','tags')->orderBy('id', 'desc')->paginate(4, ['*'], 'blog-page');
            $products = Product::with('user','categories')->orderBy('id', 'desc')->paginate(4, ['*'], 'product-page');
        }

         return view('app/index', ['blogs' => $blogs, 'products' => $products, 'categories' => $categories, 'tags' => $tags]);

    }

    public function productFilter($productTag) {

        $tags = Tag::all();

        $categories = Category::all();

        $blogs = Blog::with('user','tags')->orderBy('id', 'desc')->paginate(4, ['*'], 'product-page');

        $products = Product::with('categories')->whereHas('categories', function($query) use ($productTag) {
            $query->where('name', $productTag);
        })->get(); 

        return view('app/index', ['products' => $products, 'categories' => $categories, 'blogs' => $blogs, 'tags' => $tags]);

    }

    public function blogFilter($blogTag) {

         $tags = Tag::all();

         $categories = Category::all();

         $products = Product::with('user','categories')->orderBy('id', 'desc')->paginate(4, ['*'], 'blog-page');

         $blogs = Blog::with('tags')->whereHas('tags', function($query) use ($blogTag) {
            $query->where('name', $blogTag);
        })->get(); 

        return view('app/index', ['blogs' => $blogs, 'tags' => $tags, 'products' => $products, 'categories' => $categories]);

    }

}
