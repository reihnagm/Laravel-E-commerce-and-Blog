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

    public function update(Request $request, $id)
    {
        if (auth()->check()) {
            Cart::instance('default')->update($id, ['qty' => $request->qty]);
        } else {
            Cart::instance('guest')->update($id, ['qty' => $request->qty]);
        }

        return back();
    }

    public function destroy($id)
    {
        if (auth()->check()) {
            // REMOVE FOR USER WHEN LOGGED IN
            Cart::remove($id);
        } else {
            // REMOVE FOR USER AS GUEST
            Cart::instance('guest')->remove($id);
        }

        Toastr::info('Item has been removed!');

        return back();
    }

    public function addCart(Request $request)
    {
        if (auth()->check()) {

            // ADD CART FOR USER WHEN LOGGED IN

            $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id === $request->id;
            });

            if ($duplicates->isNotEmpty()) {
                return redirect(route('cart.index'));
            }

            Cart::instance('default')->add($request->id, $request->name, 1, $request->price, ['image' => $request->img, 'money' => $request->price, 'desc' => $request->desc, 'user_id' => auth()->user() ? auth()->user()->id : null ])->associate('App\Models\Product');
        } else {

            // ADD CART FOR USER AS GUEST

            $duplicates = Cart::instance('guest')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id === $request->id;
            });

            if ($duplicates->isNotEmpty()) {
                return redirect(route('cart.index'));
            }

            Cart::instance('guest')->add($request->id, $request->name, 1, $request->price, ['image' => $request->img, 'money' => $request->price, 'desc' => $request->desc, 'user_id' => auth()->user() ? auth()->user()->id : null ])->associate('App\Models\Product');
        }

        Toastr::info('Item was added to your Cart!');

        return back();
    }

    public function switchToSaveForLater(Request $request, $id)
    {
        $item = Cart::instance('default')->get($id);

        Cart::instance('default')->remove($id);

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price, ['image' => str_replace('data:image/png;base64,', '', $request->img)])->associate('App\Models\Product');

        Toastr::info('Item has been Saved For Later!');

        return back();
    }

    public function emptySaveForLater()
    {
        Cart::instance('saveForLater')->destroy();

        Toastr::info('Item has been removed!');

        return back();
    }

    public function moveToCart(Request $request, $id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return  $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect(route('cart.index'));
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price, ['image' => str_replace('data:image/png;base64,', '', $request->img), 'money' => $item->price])->associate('App\Models\Product');

        Cart::instance('saveForLater')->remove($id);

        Toastr::info('Item has been moved to Cart!');

        return back();
    }
}
