<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Toastr;

use Illuminate\Http\Request;

class OrderController extends Controller
{

  public function orders_api($type = '')
  {

      if($type == 'pending') {
      $orders = Order::with(['products'])->where('delivered', '0')->get();
    } else if ( $type == 'delivered') {
      $orders = Order::with(['products'])->where('delivered', '1')->get();
    } else {
      $orders = Order::with(['products'])->get();
    }

      return $orders;

  }

  public function orders($type = '')
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

    if($request->has('delivered'))  {

      $order->delivered = $request->delivered; 

      Toastr::info('Changed to delivered successfullly');
    }
    else  {

      $order->delivered = 0;

      Toastr::info('Changed to pending successfullly');

    }

    $order->save();

    return back();

  }

}
