<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Order extends BaseDimmer
{

    protected $config = [];


    public function run()
    {
        $count = \App\Models\Order::count();
        $string = 'Orders';

        return view('voyager::dimmer', array_merge($this->config,[
            'icon'   => 'voyager-documentation',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.post_text', ['count' => $count,
                'string' => Str::lower($string)]),
            'button' => [
                'text' => 'View all orders',
                'link' => '',
            ],
            'image' => '/widgets/orders.jpg',
        ]));
    }


}
