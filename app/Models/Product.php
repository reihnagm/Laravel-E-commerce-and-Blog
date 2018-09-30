<?php

namespace App\Models;

use Auth;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use Rateable;

    protected $guarded = ['id'];

    public function user()
    {

        return $this->belongsTo('App\Models\User');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Models\Category');

    }

    public function orders()
    {

      return $this->hasMany('App\Models\Order');

    }

    public function mightAlsoLike($query)
    {

      return $query->inRandomOrder()->take(4);

    }

}
