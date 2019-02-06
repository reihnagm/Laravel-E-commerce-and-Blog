<?php

namespace App\Widgets;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class User extends BaseDimmer
{

    protected $config = [];


    public function run()
    {
        $count = \App\Models\User::count();
        $string = 'Users';

        return view('voyager::dimmer', array_merge($this->config,[
            'icon'   => 'voyager-person',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.post_text', ['count' => $count,
                'string' => Str::lower($string)]),
            'button' => [
                'text' => 'View all users',
                'link' => Route('voyager.users.index'),
            ],
            'image' => '/widgets/users.jpg',
        ]));
    }

    // public function shouldBeDisplayed()
    // {
    //     return Auth::user()->can('browse', Voyager::model('User'));
    // }

}
