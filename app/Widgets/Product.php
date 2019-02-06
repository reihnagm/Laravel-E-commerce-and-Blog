<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Product extends BaseDimmer
{

    protected $config = [];


    public function run()
    {
        $count = \App\Models\Product::count();
        $string = 'Products';

        return view('voyager::dimmer', array_merge($this->config,[
            'icon'   => 'voyager-bag',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.post_text', ['count' => $count,
                'string' => Str::lower($string)]),
            'button' => [
                'text' => 'View all products',
                'link' => route('voyager.products.index'),
            ],
            'image' => '/widgets/products.jpg',
        ]));
    }

}
