<?php

namespace App\Models;

use Auth;

 trait UnlikesTrait
 {

   public function unlikes()
   {
   
    return $this->morphMany('App\Models\Unlike', 'unlikeable');
   
   }

   public function is_unliked()
   {
  
    return $this->unlikes->where('user_id', Auth::user()->id)->count();
  
   }

 }
