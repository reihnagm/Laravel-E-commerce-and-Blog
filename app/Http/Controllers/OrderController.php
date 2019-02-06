<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Toastr;

use Illuminate\Http\Request;

class OrderController extends Controller
{

  public function index() 
  {
      return view('order.index', ["orders" => auth()->user()->orders()->with('products')->get() ]);
  }

  public function orders_index()
  {
      return Order::with(['products.user'])->get();
  }

    public function orders_pending()
  {
      return Order::with(['products.user'])->where('delivered', '0')->get();
  }

    public function orders_delivered()
  {
     $orders = Order::with(['products.user'])->where('delivered', '1')->get();

     return $orders;
  }


  public function orders() // $type = ''
  {

    // if($type == 'pending') {
    //   $orders = Order::where('delivered', '0')->get();
    // } else if  ( $type == 'delivered') {
    //   $orders = Order::where('delivered', '1')->get();
    // } else {
      // $orders = Order::all();
    // }

    return view('admin/order', ['orders' =>  Order::all()]);

  }

  // public function toggleDeliver(Request $request, $orderId)
  // {

  //   $order = Order::findOrFail($orderId);

  //   if($request->has('delivered'))  {

  //     $order->delivered = $request->delivered;

  //     Toastr::info('Changed to delivered successfullly');
  //   }
  //   else  {

  //     $order->delivered = 0;

  //     Toastr::info('Changed to pending successfullly');

  //   }

  //   $order->save();

  //   return back();

  // }

   public function toggleDeliver(Request $request, $orderId)
  {

    $order = Order::findOrFail($orderId);

    if($request->has('delivered'))  {

      $order->delivered = $request->delivered;

    }
    else  {

      $order->delivered = 0;

    }

    $order->save();

    return json_encode([
      "message" => "success"
    ]);

  }

}
