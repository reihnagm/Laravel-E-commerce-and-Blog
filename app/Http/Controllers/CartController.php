<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;
use DB;
use Toastr;

use App\Models\User;
use App\Models\Product;

class CartController extends Controller
{

    public function index()
    {

      $carts = Cart::content();
      
      return view('cart/index', ['carts' => $carts]);

    }

    public function create()
    {

      
    }

    public function store(Request $request)
    {

      // $duplicates = Cart::search(function($cartItem, $rowId) use($productId) {
      //   return $cartItem->id === $productId;
      // });

      // if($duplicates->isNotEmpty()) 
      //   return redirect(route('cart.index'));
   
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
     

    }

    public function update(Request $request, $id)
    {

      Cart::update($id, ['qty' => $request->qty ]);

      return back();

    }

    public function destroy($id)
    {

      Cart::remove($id);

      Toastr::success('Item has been removed!');

      return back();

    }

    public function addCart($productId) 
    {
      
      $product = Product::findOrFail($productId);

      Cart::instance('default')->add($productId, $product->name, 1, $product->price, ['image' => $product->img, 'user_id' => auth()->user()->id])->associate('App\Models\Product');

      Toastr::info('Item was added to your Cart!');

      return back();

    }

    public function switchToSaveForLater(Request $request, $id)
    {

      $item = Cart::get($id);

      Cart::remove($id);

      Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price, ['image' => str_replace('data:image/png;base64,', '', $request->img)])->associate('App\Models\Product');

      Toastr::success('Item has been Saved For Later!');

      return back();

    }

}
