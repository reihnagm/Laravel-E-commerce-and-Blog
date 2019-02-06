<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
      'user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
      'billing_province', 'billing_postalcode', 'billing_phone', 'billing_name_on_card', 'billing_discount', 'billing_discount_code', 'billing_subtotal', 'billing_tax', 'billing_total', 'payment_gateway', 'error',
  ];

    public function products()
    {

      return $this->belongsToMany('App\Models\Product')->withPivot('quantity');

    }

    public function user()
    {

      return $this->belongsTo('App\Models\User');

    }


    // public static function createOrder()
    // {

    //   $user = Auth::user();

    //   $order = $user->orders()->create([
    //     'total' => Cart::total(),
    //     'delivered' => 0
    //   ]);

    //   $carts = Cart::content();

    //   foreach ($carts as $cart) {

    //     $order->orderItems()->attach($cart->id, [
    //       'qty' => $cart->qty,
    //       'total' => $cart->total * $cart->price
    //     ]);

    //   }

    // }

}
