<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Blog extends BaseDimmer
{

    protected $config = [];

    public function run()
    {
        $count = \App\Models\Blog::count();
        $string = 'Blogs';

        return view('voyager::dimmer', array_merge($this->config,[
            'icon'   => 'voyager-book',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.post_text', ['count' => $count,
                'string' => Str::lower($string)]),
            'button' => [
                'text' => 'View all blogs',
                'link' => Route('voyager.blogs.index'),
            ],
            'image' => '/widgets/blogs.jpg',
        ]));
    }

}
