<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Toastr;

use Illuminate\Http\Request;

class OrderController extends Controller
{

  public function orders()
  {

    if($type == 'pending') {
      $orders = Order::where('delivered', '0')->get();
    } else if  ( $type == 'delivered') {
      $orders = Order::where('delivered', '1')->get();
    } else {
      $orders = Order::all();
    }

    return view('admin/order', ['orders' => $orders]);

  }

  public function toggleDeliver(Request $request, $orderId)
  {

    $order = Order::findOrFail($orderId);

    if($request->has('delivered')) {

      $order->delivered = $request->delivered;

    }
    else {

      $order->delivered = 0;

    }

    $order->save();

    return back();

  }

}
