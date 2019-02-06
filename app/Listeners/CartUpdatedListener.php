<?php

namespace App\Listeners;

use App\Models\Coupon;
use App\Jobs\UpdateCoupon;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CartUpdatedListener
{
   
    public function __construct()
    {
      
    }

    public function handle($event)
    {
        $couponName = session()->get('coupon')['name'];

        if ($couponName) {
			
            $coupon = Coupon::where('code', $couponName)->first();

            dispatch_now(new UpdateCoupon($coupon));
			
        }
    }
	
}
