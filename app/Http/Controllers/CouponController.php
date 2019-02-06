<?php

namespace App\Http\Controllers;

use Toastr;
use Cart;

use Illuminate\Http\Request;

use App\Models\Coupon;

class CouponController extends Controller
{
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
              
        if (!$coupon) {
            Toastr::info('Invalid coupon code. Please try again.');
            return redirect(route('checkout.index'));
        }
        
        $discount = auth()->check() ? $coupon->discount(Cart::instance('default')->subtotal()) : $coupon->discount(Cart::instance('guest')->subtotal());

        session()->put('coupon', [
        "name" => $coupon->code,
        "discount" => $discount,
        ]);

        Toastr::info('Successfully! coupon has been appplied!');

        if(auth()->check()) {
             return redirect(route('checkout.index'));
        } else {
            return back();
        }
       
    }
    
    public function destroy()
    {
      
        session()->forget('coupon');

        Toastr::info('Coupon has been removed!');
        
        return back();
    }
}
