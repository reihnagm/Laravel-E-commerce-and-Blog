<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function products()
    {

      return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'total');

    }

    public function user()
    {

      return $this->belongsTo('App\Models\User');

    }

    public static function createOrder()
    {

      $user = Auth::user();

      $order = $user->orders()->create([

        'total' => Cart::total(),
        'delivered' => 0

      ]);

      $carts = Cart::content();

      foreach ($carts as $cart) {

        $order->orderItems()->attach($cart->id, [
          'qty' => $cart->qty,
          'total' => $cart->total * $cart->price
        ]);

      }

    }

}
