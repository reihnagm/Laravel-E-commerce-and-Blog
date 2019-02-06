<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 
     protected $guarded = ['id'];
 
    // ADDING USE ADDITIONAL VOYAGER RELATIONSHIP
     public function userId()
    {

      return $this->belongsTo('App\Models\User');

    }

    public function user()
    {

      return $this->belongsTo('App\Models\User');

    }

    // ADDING USE ADDITIONAL VOYAGER RELATIONSHIP
    public function categoryId()
    {

      return $this->belongsToMany('App\Models\Category');
    // IF NOT USE CONVESION NAME   
    // return $this->belongsToMany('App\Models\Group', 'product_group');

    }

      public function category()
    {

      return $this->belongsToMany('App\Models\Category');
    // IF NOT USE CONVESION NAME  
    // return $this->belongsToMany('App\Models\Group', 'product_group');

    }

    public function orders()
    {

      return $this->hasMany('App\Models\Order');

    }

}
