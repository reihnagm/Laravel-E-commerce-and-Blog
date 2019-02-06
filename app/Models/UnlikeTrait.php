<?php

namespace App\Models;

 trait UnlikesTrait
 {

   public function unlikes()
   {
   
    return $this->morphMany('App\Models\Unlike', 'unlikeable');
   
   }

   public function isUnliked()
   {
  
    return $this->unlikes->where('user_id', auth()->user()->id)->count();
  
   }

 }
