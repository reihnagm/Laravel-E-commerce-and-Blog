<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;
use DB;
use Toastr;
use Auth;

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

      Cart::update($id, ['qty' => $request->qty]);

      return back();

    }

    public function destroy($id)
    {

      Cart::remove($id);

      Toastr::info('Item has been removed!');

      return back();

    }

    public function addCart(Request $request) 
    { 
     
      $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use($request) {
        return $cartItem->id === $request->id;
      });

      if($duplicates->isNotEmpty()) {
        return redirect(route('cart.index'));
      }

      if(Auth::check()) {
       Cart::instance('default')->add($request->id, $request->name, 1, $request->price, ['image' => $request->img, 'money' => $request->price, 'user_id' => auth()->user()->id])->associate('App\Models\Product');
      } else {
        Toastr::info('You must Login before!');
        return back();
      }

      Toastr::info('Item was added to your Cart!');

      return back();

    }

    public function switchToSaveForLater(Request $request, $id)
    {
      
      $item = Cart::get($id);

      Cart::remove($id);

      Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price, ['image' => str_replace('data:image/png;base64,', '', $request->img)])->associate('App\Models\Product');
    
      Toastr::info('Item has been Saved For Later!');

      return back();

    }

    public function emptySaveForLater()
    {

      /*-------------------------------------------------
      -- CART INSTANCE : Ex : wishlist, default : default
      ---------------------------------------------------*/

      Cart::instance('saveForLater')->destroy();

      Toastr::info('Item has been removed!');

      return back();

    }

    public function moveToCart(Request $request, $id) 
    {
          
      $item = Cart::instance('saveForLater')->get($id);
      
      Cart::instance('saveForLater')->remove($id);

      $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
        return  $rowId === $id;
      });

      if($duplicates->isNotEmpty()) {
        return redirect(route('cart.index'));
      }

      Cart::instance('default')->add($item->id, $item->name, 1, $item->price, ['image' => str_replace('data:image/png;base64,', '', $request->img)])->associate('App\Models\Product');
    
      Toastr::info('Item has been moved to Cart!');

      return back();

    }

}
