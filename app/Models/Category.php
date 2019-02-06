<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

   protected $table = 'category';

   public $timestamps  = false;

   public function products()
   {

       return $this->belongsToMany('App\Models\Product'); 

   }

   // public function products()
   // {
   //
   //     return $this->belongsToMany('App\Models\Product', 'product_group'); // product_group
   //
   // }

}
