<?php

namespace App\Http\Controllers;

use Cart;
use Auth;

use App\Models\Order;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {

      return view('payment.index');

    }

    public function store(Request $request)
    {

      // Set your secret key: remember to change this to your live secret key in production
      // See your keys here: https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey("sk_test_ajJcmURbVSHaLsJTZbR2haXb");

      // Token is created using Checkout or Elements!
      // Get the payment token ID submitted by the form:
      $token = $request->stripeToken;
      $charge = \Stripe\Charge::create([
          'amount' => Cart::total()*100,
          'currency' => 'usd',
          'description' => 'Example charge',
          'source' => $token,
      ]);

      Order::createOrder();

    }

}
