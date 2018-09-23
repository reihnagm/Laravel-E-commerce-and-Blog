<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

class ShippingController extends Controller
{

    public function shipping()
    {

      return view('checkout/index');

    }

}
