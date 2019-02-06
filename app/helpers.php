<?php

function dollarPrice($price)
{
   
   return number_format($price, 2);
   
}


function changeToIdr($price) 
{
	
	$idr = $price * 14;
	
	return number_format($idr, 3);
	
}

function showDate($date)
{
	
  return date(str_replace("-", " ","d-F-Y"), strtotime($date));
	
}

function showImage($path)
{

  return ($path) && file_exists('storage/'. $path) ? asset('storage/'.$path) : asset('images/not-found.jpg');

}

function getNumbers()
{
	
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (Cart::instance('default')->subtotal() - $discount);
    $guestNewSubTotal = (Cart::instance('guest')->subtotal() - $discount);
    
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }
    if ($guestNewSubTotal < 0) {
        $guestNewSubTotal = 0;
    }

    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    $guestNewTax = $guestNewSubTotal * $tax;
    $guestNewTotal = $guestNewSubTotal * (1 + $tax);

    return collect([
        'tax' => $tax,
        'discount' => $discount,
                
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,

        'guestNewSubTotal' => $guestNewSubTotal,
        'guestNewTax' => $guestNewTax,
        'guestNewTotal' => $guestNewTotal,
    ]);
	
}
