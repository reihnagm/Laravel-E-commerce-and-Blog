<?php

namespace App\Models;

use Auth;
use Cache;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use LikesTrait, UnlikesTrait;

    use Notifiable;

    protected $guarded = [];

    protected $hidden = [

        'password', 'remember_token'

    ];

     public function blogs()
    {

        return $this->hasMany('App\Models\Blog');

    }

    public function products()
    {

        return $this->hasMany('App\Models\Product');

    }

     public function comments()
    {

        return $this->hasMany('App\Models\BlogComment');

    }

    public function isOwner()
    {

      if(Auth::check()) {

        return Auth::user()->id == $this->id;

      }

    }

      public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function addresses()
    {

      return $this->hasMany('App\Models\Address');

    }

    public function orders()
    {

      return $this->hasMany('App\Models\Order');

    }

}
